<?php namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;

class User extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    public function show($id = null)
    {
        $data['user'] = $this->userModel->find($id);

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user: ' . $id);
        }

        return view('users/detail', $data);
    }

    public function new()
    {
        helper('form'); // Load form helper for form_open() etc.
        return view('users/new');
    }

    public function create()
    {
        helper('form'); // Load form helper for validation

        $rules = [
            'username' => 'required|min_length[3]|max_length[255]',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];

        if (! $this->validate($rules)) {
            return view('users/new', ['validation' => $this->validator]);
        }

        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ]);

        return redirect()->to('/users');
    }
}
