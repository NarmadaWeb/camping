<?php namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table      = 'users'; // In a real app, this would be a database table
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array'; // or 'object'
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'email'];

    // Timestamps
    protected $useTimestamps = true; // Set to true if you have 'created_at' and 'updated_at' fields
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules    = [
        'username' => 'required|alpha_numeric_space|min_length[3]|max_length[255]|is_unique[users.username]',
        'email'    => 'required|valid_email|is_unique[users.email]',
    ];
    protected $validationMessages = [
        'username' => [
            'is_unique' => 'Sorry, that username has already been taken.'
        ],
        'email' => [
            'is_unique' => 'Sorry, that email has already been taken.'
        ]
    ];
    protected $skipValidation     = false;
    protected $cleanValidationRules = true; // Added for better validation management

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $afterDelete    = [];
}
