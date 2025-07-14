<?php

namespace App\Controllers;

use App\Models\CampsiteModel;
use CodeIgniter\Controller;

class CampsiteController extends Controller
{
    public function index()
    {
        $campsiteModel = new CampsiteModel();
        $data["campsites"] = $campsiteModel->findAll(); // Mengambil semua data lokasi perkemahan

        echo view("campsites/index", $data);
    }

    public function show($id = null)
    {
        $campsiteModel = new CampsiteModel();
        $data["campsite"] = $campsiteModel->find($id);

        if (empty($data["campsite"])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                "Lokasi Perkemahan tidak ditemukan: " . $id
            );
        }

        echo view("campsites/show", $data);
    }
}
