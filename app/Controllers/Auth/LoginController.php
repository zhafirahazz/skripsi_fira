<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\User;
use Exception;

class LoginController extends BaseController
{
    protected $model;
    protected $session;

    public function __construct()
    {
        $this->model = new User();
        $this->session = session();
    }

    public function index()
    {
        return view('templates/auth/_header', ["title" => "Login"])
            . view('auth/login')
            . view('templates/auth/_footer');
    }

    public function login()
    {
        try {
            $email = $this->request->getPost('email');
            $passwd = $this->request->getPost('password');

            $user = $this->model->where('email', $email)->first();
            if (is_null($user)) {
                throw new Exception("User not found!");
            }

            if (!password_verify($passwd, $user["password"])) {
                $this->session->setFlashdata('error', 'Wrong Password!');
            }

            $newSessionData = [
                "name" => $user["name"],
                "role" => $user["role_id"],
                "uid" => $user["id"],
                "logged_in" => TRUE,
                "approved" => $user["approved"]
            ];

            $this->session->set($newSessionData);
            return redirect()->route('dashboard.index');
        } catch (Exception $e) {
            $this->session->setFlashdata('error', $e->getMessage());
            return redirect()->route('login');
        }
    }

    function logout()
    {
        $this->session->destroy();
        return redirect()->route('login');
    }
}
