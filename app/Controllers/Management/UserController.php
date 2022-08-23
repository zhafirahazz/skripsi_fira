<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\Role;
use App\Models\User;

class UserController extends BaseController
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
        $this->Role = new Role();
        $this->session = session();
    }

    public function index()
    {
        $users = $this->model
            ->select('user.*, role.role_display')
            ->orderBy('user.name', 'asc')
            ->join('role', 'user.role_id = role.id')
            ->findAll();

        return view('admin/user/index', ["users" => $users]);
    }

    public function create()
    {
        // TO DISPLAY CREATE USER VIEW
        return view('admin/user/create');
    }

    public function store()
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "name" => $this->request->getPost('name'),
            "email" => $this->request->getPost('email'),
            "password" => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            "role_id" => $this->request->getPost('role'),
            "approved" => TRUE
        ];

        $this->model->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('user.index');
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('user.index'));
    }
}
