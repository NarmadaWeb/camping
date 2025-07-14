<?php

namespace App\Models;

use CodeIgniter\Model;

class CampsiteModel extends Model
{
    protected $table = 'campsites';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'location', 'price_per_night', 'capacity', 'image', 'facilities'];
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
