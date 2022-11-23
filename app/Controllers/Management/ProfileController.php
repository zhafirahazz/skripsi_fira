<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\Role;
use App\Models\User;
use Exception;

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
        $id = $this->session->get('uid');
        $profiles = $this->model
            ->select('user.id, user.name, user.email, role.role_display')
            ->join('role', 'user.role_id = role.id')
            ->where('user.id', $id)->first();

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


    public function updatePassword($id){
       try{
        $data = [
            "old_pwd" => $this->request->getPost('password'),
            "new_pwd" => $this->request->getPost('new_password'),
            "c_pwd" => $this->request->getPost('c_password'),
        ];

        if($data["new_pwd"] != $data["c_pwd"]){
            throw new Exception("Password dan konfirmasi tidak sesuai!");
        }

        $profile = $this->model->where('id', $id)->first();
        if (!password_verify($data["old_pwd"], $profile["password"])) {
            throw new Exception("Password lama salah!");
        }

        $profile["password"] = password_hash($data["new_pwd"], PASSWORD_BCRYPT);
        $this->model->save($profile);
        $this->session->setFlashdata('success', "Data berhasil diubah");
        return redirect()->to(route_to('profile.index'));

       }catch(Exception $e){

        $this->session->setFlashdata('error', $e->getMessage());
        return redirect()->to(route_to('profile.index'));
       }
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
