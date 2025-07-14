<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'campsite_id', 'check_in_date', 'check_out_date', 'total_price', 'status'];
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation rules (optional, but good practice)
    protected $validationRules = [
        'user_id'        => 'required|integer',
        'campsite_id'    => 'required|integer',
        'check_in_date'  => 'required|valid_date',
        'check_out_date' => 'required|valid_date',
        'total_price'    => 'required|numeric',
        'status'         => 'permit_empty|in_list[pending,confirmed,cancelled,completed]',
    ];
}
