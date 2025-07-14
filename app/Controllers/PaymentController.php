<?php

namespace App\Controllers;

use App\Models\PaymentModel;
use App\Models\BookingModel;
use CodeIgniter\Controller;

class PaymentController extends Controller
{
    public function checkout($booking_id)
    {
        // Get booking details
        $bookingModel = new BookingModel();
        $booking = $bookingModel->select('
            bookings.*,
            campsites.name as campsite_name,
            campsites.location
        ')
        ->join('campsites', 'campsites.id = bookings.campsite_id')
        ->find($booking_id);

        if (empty($booking)) {
            return redirect()->to('/my-bookings')->with('error', 'Pemesanan tidak ditemukan');
        }

        // Verify that the booking belongs to the current user
        if ($booking['user_id'] != session()->get('user_id')) {
            return redirect()->to('/my-bookings')->with('error', 'Anda tidak memiliki akses ke pemesanan ini');
        }

        // Verify booking status (only pending bookings can be paid)
        if ($booking['status'] != 'pending') {
            return redirect()->to('/my-bookings')->with('error', 'Pemesanan ini tidak dapat dibayar karena status ' . $booking['status']);
        }

        // Check if payment already exists
        $paymentModel = new PaymentModel();
        $existingPayment = $paymentModel->where('booking_id', $booking_id)
                                        ->where('payment_status', 'completed')
                                        ->first();

        if ($existingPayment) {
            return redirect()->to('/my-bookings')->with('error', 'Pemesanan ini sudah dibayar');
        }

        $data['booking'] = $booking;
        return view('payments/checkout', $data);
    }

    public function store()
    {
        $bookingId = $this->request->getPost('booking_id');
        $amount = $this->request->getPost('amount');
        $paymentMethod = $this->request->getPost('payment_method');

        // Validate booking
        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($bookingId);

        if (empty($booking)) {
            return redirect()->to('/my-bookings')->with('error', 'Pemesanan tidak ditemukan');
        }

        // Verify that the booking belongs to the current user
        if ($booking['user_id'] != session()->get('user_id')) {
            return redirect()->to('/my-bookings')->with('error', 'Anda tidak memiliki akses ke pemesanan ini');
        }

        // Handle file upload
        $proofFile = null;

        if ($paymentMethod === 'bank_transfer') {
            $proof = $this->request->getFile('proof_of_payment');
        } else {
            $proof = $this->request->getFile('proof_of_payment_ewallet');
        }

        if ($proof && $proof->isValid() && !$proof->hasMoved()) {
            $newName = $proof->getRandomName();
            $proof->move(ROOTPATH . 'public/uploads/payments', $newName);
            $proofFile = $newName;
        } else {
            return redirect()->back()->with('error', 'Bukti pembayaran tidak valid. Silakan unggah file gambar.');
        }

        // Create payment record
        $paymentModel = new PaymentModel();
        $paymentData = [
            'booking_id' => $bookingId,
            'amount' => $amount,
            'payment_method' => $paymentMethod,
            'payment_status' => 'pending', // Admin will confirm and update to 'completed'
            'proof_of_payment' => $proofFile,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $paymentModel->insert($paymentData);

        // Update booking status to pending payment confirmation
        $bookingModel->update($bookingId, ['status' => 'pending']);

        return redirect()->to('/my-bookings')->with('success', 'Pembayaran berhasil dikirim dan menunggu konfirmasi admin');
    }

    public function myPayments()
    {
        $userId = session()->get('user_id');
        $paymentModel = new PaymentModel();
        $data['payments'] = $paymentModel->getPaymentsByUserId($userId);

        return view('payments/my_payments', $data);
    }

    // Admin methods
    public function adminIndex()
    {
        $paymentModel = new PaymentModel();
        $data['payments'] = $paymentModel->getPaymentWithDetails();

        return view('admin/payments/index', $data);
    }

    public function adminView($id)
    {
        $paymentModel = new PaymentModel();
        $data['payment'] = $paymentModel->getPaymentWithDetails($id);

        if (empty($data['payment'])) {
            return redirect()->to('/admin/payments')->with('error', 'Pembayaran tidak ditemukan');
        }

        return view('admin/payments/view', $data);
    }

    public function adminUpdate($id)
    {
        $paymentModel = new PaymentModel();
        $payment = $paymentModel->find($id);

        if (empty($payment)) {
            return redirect()->to('/admin/payments')->with('error', 'Pembayaran tidak ditemukan');
        }

        $status = $this->request->getPost('status');
        $validStatuses = ['pending', 'completed', 'failed', 'refunded'];

        if (!in_array($status, $validStatuses)) {
            return redirect()->to('/admin/payments')->with('error', 'Status tidak valid');
        }

        $paymentModel->update($id, [
            'payment_status' => $status,
            'payment_date' => date('Y-m-d H:i:s'),
            'notes' => $this->request->getPost('notes')
        ]);

        // If payment is completed, update booking status to confirmed
        if ($status === 'completed') {
            $bookingModel = new BookingModel();
            $bookingModel->update($payment['booking_id'], ['status' => 'confirmed']);
        }

        // If payment is failed or refunded, update booking status to appropriate value
        if ($status === 'failed') {
            $bookingModel = new BookingModel();
            $bookingModel->update($payment['booking_id'], ['status' => 'pending']);
        }

        if ($status === 'refunded') {
            $bookingModel = new BookingModel();
            $bookingModel->update($payment['booking_id'], ['status' => 'cancelled']);
        }

        return redirect()->to('/admin/payments')->with('success', 'Status pembayaran berhasil diperbarui');
    }
}
