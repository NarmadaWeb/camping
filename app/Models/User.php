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
    protected $useTimestamps = false; // Set to true if you have 'created_at' and 'updated_at' fields
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules    = [
        'username' => 'required|alpha_numeric_space|min_length[3]|max_length[255]',
        'email'    => 'required|valid_email|is_unique[users.email]',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $afterDelete    = [];

    // For demonstration, let's add a simple in-memory "database"
    private static $inMemoryData = [
        1 => ['id' => 1, 'username' => 'JohnDoe', 'email' => 'john@example.com'],
        2 => ['id' => 2, 'username' => 'JaneSmith', 'email' => 'jane@example.com'],
    ];

    public function find($id = null)
    {
        if ($id === null) {
            return array_values(self::$inMemoryData);
        }
        return self::$inMemoryData[$id] ?? null;
    }

    public function insert($data = null, bool $returnID = true)
    {
        $id = count(self::$inMemoryData) + 1;
        $data['id'] = $id;
        self::$inMemoryData[$id] = $data;
        return $returnID ? $id : true;
    }
}
