<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get("isLoggedIn")) {
            return redirect()->to("/dashboard");
        }

        // Get a few featured campsites
        $campsiteModel = new \App\Models\CampsiteModel();
        $data["featured_campsites"] = $campsiteModel
            ->orderBy("id", "RANDOM")
            ->limit(3)
            ->find();

        return view("home", $data);
    }

    public function dashboard()
    {
        $session = session();
        // This check is a fallback; the 'auth' filter should handle most cases.
        if (!$session->get("isLoggedIn")) {
            return redirect()->to("/login");
        }
        $data["username"] = $session->get("username");
        return view("dashboard", $data);
    }
}
