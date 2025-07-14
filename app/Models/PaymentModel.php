<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['booking_id', 'amount', 'payment_method', 'transaction_id', 'payment_status', 'payment_date', 'proof_of_payment', 'notes'];
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules
    protected $validationRules = [
        'booking_id'     => 'required|integer',
        'amount'         => 'required|numeric',
        'payment_method' => 'required',
        'payment_status' => 'permit_empty|in_list[pending,completed,failed,refunded]',
    ];

    // Get payments with booking details
    public function getPaymentWithDetails($id = null)
    {
        $builder = $this->db->table('payments');
        $builder->select('
            payments.*,
            bookings.user_id, bookings.check_in_date, bookings.check_out_date, bookings.status as booking_status,
            campsites.name as campsite_name, campsites.location,
            users.username, users.email
        ');
        $builder->join('bookings', 'bookings.id = payments.booking_id');
        $builder->join('campsites', 'campsites.id = bookings.campsite_id');
        $builder->join('users', 'users.id = bookings.user_id');

        if ($id !== null) {
            $builder->where('payments.id', $id);
            return $builder->get()->getRowArray();
        }

        $builder->orderBy('payments.created_at', 'DESC');
        return $builder->get()->getResultArray();
    }

    // Get all payments for a specific booking
    public function getPaymentsByBookingId($bookingId)
    {
        return $this->where('booking_id', $bookingId)
                   ->orderBy('created_at', 'DESC')
                   ->findAll();
    }

    // Get payments by user ID (joining with bookings table)
    public function getPaymentsByUserId($userId)
    {
        $builder = $this->db->table('payments');
        $builder->select('
            payments.*,
            bookings.check_in_date, bookings.check_out_date, bookings.status as booking_status,
            campsites.name as campsite_name, campsites.location
        ');
        $builder->join('bookings', 'bookings.id = payments.booking_id');
        $builder->join('campsites', 'campsites.id = bookings.campsite_id');
        $builder->where('bookings.user_id', $userId);
        $builder->orderBy('payments.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }

    // Get payments with filters for admin
    public function getFilteredPayments($filters = [])
    {
        $builder = $this->db->table('payments');
        $builder->select('
            payments.*,
            bookings.user_id, bookings.check_in_date, bookings.check_out_date, bookings.status as booking_status,
            campsites.name as campsite_name, campsites.location,
            users.username, users.email
        ');
        $builder->join('bookings', 'bookings.id = payments.booking_id');
        $builder->join('campsites', 'campsites.id = bookings.campsite_id');
        $builder->join('users', 'users.id = bookings.user_id');

        // Apply filters
        if (!empty($filters['payment_status'])) {
            $builder->where('payments.payment_status', $filters['payment_status']);
        }

        if (!empty($filters['payment_method'])) {
            $builder->where('payments.payment_method', $filters['payment_method']);
        }

        if (!empty($filters['start_date']) && !empty($filters['end_date'])) {
            $builder->where('payments.created_at >=', $filters['start_date']);
            $builder->where('payments.created_at <=', $filters['end_date']);
        }

        if (!empty($filters['search'])) {
            $builder->groupStart()
                ->like('users.username', $filters['search'])
                ->orLike('users.email', $filters['search'])
                ->orLike('campsites.name', $filters['search'])
                ->orLike('payments.transaction_id', $filters['search'])
            ->groupEnd();
        }

        $builder->orderBy('payments.created_at', 'DESC');

        return $builder->get()->getResultArray();
    }
}
