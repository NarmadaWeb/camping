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
        helper(['form', 'session']); // Load form and session helpers

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        if (! $this->userModel->save($data)) {
            // Validation failed, return to form with errors
            session()->setFlashdata('errors', $this->userModel->errors());
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('message', 'User created successfully.');
        return redirect()->to('/users');
    }

    public function delete($id = null)
    {
        helper('session'); // Load session helper

        if ($id === null) {
            session()->setFlashdata('error', 'User ID not provided for deletion.');
            return redirect()->to('/users');
        }

        if ($this->userModel->delete($id)) {
            session()->setFlashdata('message', 'User deleted successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to delete user or user not found.');
        }

        return redirect()->to('/users');
    }
}
