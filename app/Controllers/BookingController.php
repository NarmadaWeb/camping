<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\CampsiteModel;
use App\Models\PaymentModel;
use CodeIgniter\Controller;

class BookingController extends Controller
{
    public function index()
    {
        // Mendapatkan pemesanan milik pengguna yang sedang login
        $session = session();
        if (!$session->get("isLoggedIn")) {
            return redirect()->to("/login");
        }

        $userId = $session->get("user_id");
        $bookingModel = new BookingModel();

        // Join dengan tabel campsites untuk mendapatkan informasi lokasi perkemahan
        $data["bookings"] = $bookingModel
            ->select(
                "bookings.*, campsites.name as campsite_name, campsites.location, campsites.image"
            )
            ->join("campsites", "bookings.campsite_id = campsites.id")
            ->where("bookings.user_id", $userId)
            ->orderBy("bookings.created_at", "DESC")
            ->findAll();

        // Get payment status for each booking
        $paymentModel = new PaymentModel();
        foreach ($data["bookings"] as &$booking) {
            $payment = $paymentModel
                ->where("booking_id", $booking["id"])
                ->orderBy("created_at", "DESC")
                ->first();
            $booking["payment_status"] = $payment
                ? $payment["payment_status"]
                : null;
            $booking["payment_id"] = $payment ? $payment["id"] : null;
        }

        echo view("bookings/index", $data);
    }

    public function store()
    {
        $session = session();
        if (!$session->get("isLoggedIn")) {
            return redirect()->to("/login");
        }

        $userId = $session->get("user_id");
        $rules = [
            "campsite_id" => "required|integer",
            "check_in_date" => "required|valid_date",
            "check_out_date" => "required|valid_date",
            "number_of_guests" => "required|integer|greater_than[0]",
        ];

        if (!$this->validate($rules)) {
            $campsiteId = $this->request->getVar("campsite_id");
            return redirect()
                ->to("/campsites/view/" . $campsiteId)
                ->with("validation", $this->validator)
                ->with("error", "Ada kesalahan pada pemesanan Anda.");
        }

        $campsiteId = $this->request->getVar("campsite_id");
        $checkInDate = $this->request->getVar("check_in_date");
        $checkOutDate = $this->request->getVar("check_out_date");
        $numberOfGuests = $this->request->getVar("number_of_guests");

        // Ambil data campsite dari database untuk mendapatkan harga yang akurat
        $campsiteModel = new CampsiteModel();
        $campsite = $campsiteModel->find($campsiteId);

        if (!$campsite) {
            return redirect()
                ->to("/campsites")
                ->with("error", "Lokasi perkemahan tidak ditemukan.");
        }

        $pricePerNight = (float) $campsite["price_per_night"];

        // Validasi tanggal check-in dan check-out
        $checkInDateTime = strtotime($checkInDate);
        $checkOutDateTime = strtotime($checkOutDate);

        if ($checkInDateTime >= $checkOutDateTime) {
            return redirect()
                ->to("/campsites/view/" . $campsiteId)
                ->with(
                    "error",
                    "Tanggal check-out harus setelah tanggal check-in."
                );
        }

        // Validasi kapasitas tempat kemah
        if ($numberOfGuests > $campsite["capacity"]) {
            return redirect()
                ->to("/campsites/view/" . $campsiteId)
                ->with(
                    "error",
                    "Jumlah tamu melebihi kapasitas lokasi perkemahan."
                );
        }

        // Hitung harga total berdasarkan jumlah malam
        $nights = ceil(($checkOutDateTime - $checkInDateTime) / (60 * 60 * 24));
        $totalPrice = $pricePerNight * $nights;

        // Pastikan total_price tidak 0
        if ($totalPrice <= 0) {
            return redirect()
                ->to("/campsites/view/" . $campsiteId)
                ->with(
                    "error",
                    "Terjadi kesalahan dalam perhitungan harga. Silakan coba lagi."
                );
        }

        // Periksa ketersediaan (apakah sudah ada pemesanan di rentang tanggal tersebut)
        $bookingModel = new BookingModel();

        $existingBooking = $bookingModel
            ->where("campsite_id", $campsiteId)
            ->groupStart()
            ->where("check_in_date <=", $checkOutDate)
            ->where("check_out_date >=", $checkInDate)
            ->groupEnd()
            ->where("status !=", "cancelled")
            ->first();

        if ($existingBooking) {
            return redirect()
                ->to("/campsites/view/" . $campsiteId)
                ->with(
                    "error",
                    "Maaf, lokasi perkemahan ini sudah dipesan pada tanggal yang Anda pilih."
                );
        }

        // Simpan pemesanan ke database
        $data = [
            "user_id" => $userId,
            "campsite_id" => $campsiteId,
            "check_in_date" => $checkInDate,
            "check_out_date" => $checkOutDate,
            "total_price" => $totalPrice,
            "status" => "pending", // Status awal: pending
        ];

        $bookingModel->insert($data);

        return redirect()
            ->to("/my-bookings")
            ->with(
                "success",
                "Pemesanan berhasil dibuat! Status pemesanan Anda: PENDING"
            );
    }

    public function cancel($id = null)
    {
        $session = session();
        if (!$session->get("isLoggedIn")) {
            return redirect()->to("/login");
        }

        $userId = $session->get("user_id");
        $bookingModel = new BookingModel();

        // Cari pemesanan dan pastikan milik user ini
        $booking = $bookingModel
            ->where("id", $id)
            ->where("user_id", $userId)
            ->first();

        if (!$booking) {
            return redirect()
                ->to("/my-bookings")
                ->with("error", "Pemesanan tidak ditemukan.");
        }

        // Tidak bisa membatalkan pemesanan yang sudah selesai
        if ($booking["status"] == "completed") {
            return redirect()
                ->to("/my-bookings")
                ->with(
                    "error",
                    "Tidak dapat membatalkan pemesanan yang sudah selesai."
                );
        }

        // Update status menjadi cancelled
        $bookingModel->update($id, ["status" => "cancelled"]);

        return redirect()
            ->to("/my-bookings")
            ->with("success", "Pemesanan berhasil dibatalkan.");
    }

    public function viewPayment($id = null)
    {
        $session = session();
        if (!$session->get("isLoggedIn")) {
            return redirect()->to("/login");
        }

        $userId = $session->get("user_id");
        $bookingModel = new BookingModel();
        $paymentModel = new PaymentModel();

        // Get booking with payment details
        $booking = $bookingModel
            ->where("id", $id)
            ->where("user_id", $userId)
            ->first();

        if (!$booking) {
            return redirect()
                ->to("/my-bookings")
                ->with("error", "Pemesanan tidak ditemukan.");
        }

        $payment = $paymentModel
            ->where("booking_id", $id)
            ->orderBy("created_at", "DESC")
            ->first();

        if (!$payment) {
            return redirect()->to("/payments/checkout/" . $id);
        }

        $data["booking"] = $booking;
        $data["payment"] = $payment;

        // Get campsite details
        $campsiteModel = new CampsiteModel();
        $data["campsite"] = $campsiteModel->find($booking["campsite_id"]);

        return view("payments/view", $data);
    }
}
