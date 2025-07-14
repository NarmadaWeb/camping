<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        helper(["form"]);
        $data = [];
        echo view("Auth/register", $data);
    }

    public function store()
    {
        helper(["form"]);
        $rules = [
            "username" =>
                "required|min_length[3]|max_length[20]|is_unique[users.username]",
            "email" =>
                "required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]",
            "password" => "required|min_length[8]|max_length[255]",
            "confirmpassword" => "matches[password]",
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();
            $data = [
                "username" => $this->request->getVar("username"),
                "email" => $this->request->getVar("email"),
                "password" => $this->request->getVar("password"),
            ];
            $userModel->save($data);
            $session = session();
            $session->setFlashdata(
                "success",
                "Pendaftaran berhasil! Silakan login."
            );
            return redirect()->to("/login");
        } else {
            $data["validation"] = $this->validator;
            echo view("Auth/register", $data);
        }
    }

    public function login()
    {
        helper(["form"]);
        echo view("Auth/login");
    }

    public function auth()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getVar("username");
        $password = $this->request->getVar("password");

        $user = $userModel->where("username", $username)->first();

        if ($user) {
            $pass = $user["password"];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    "user_id" => $user["id"],
                    "username" => $user["username"],
                    "email" => $user["email"],
                    "role" => $user["role"] ?? "user",
                    "isLoggedIn" => true,
                ];
                $session->set($ses_data);
                return redirect()->to("/dashboard"); // Ganti dengan halaman dashboard setelah login
            } else {
                $session->setFlashdata("error", "Password salah.");
                return redirect()->to("/login");
            }
        } else {
            $session->setFlashdata("error", "Username tidak ditemukan.");
            return redirect()->to("/login");
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to("/login");
    }
}
