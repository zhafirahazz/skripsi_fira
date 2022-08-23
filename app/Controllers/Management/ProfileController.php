<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\Role;
use App\Models\User;

class ProfileController extends BaseController
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
        $profiles = $this->model
            ->select('user.id, user.name, user.email, role.role_display')
            ->join('role', 'user.role_id = role.id')
            ->first();

        return view('admin/profile/index', ["profiles" => $profiles]);
    }
    public function edit($id)
    {
        // TO DISPLAY EDIT USER VIEW
        $profile = $this->model
            ->select('*')
            ->from('user as u')
            ->where('u.id', $id)
            ->first();

        $role = $this->Role->findAll();
        return view('admin/profile/edit', ["profile" => $profile, "roles" => $role]);
    }

    public function update($id)
    {
        $data = [
            "name" => $this->request->getPost('name'),
            "role_id" => $this->request->getPost('role_id'),
            "email" => $this->request->getPost('email'),
        ];

        $profile = $this->model->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('profile.index'));
    }
}
