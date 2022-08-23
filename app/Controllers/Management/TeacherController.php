<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\Teacher;

class TeacherController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new Teacher();
        $this->session = session();
    }

    public function index()
    {
        $teachers = $this->model
            ->orderBy('teacher.name','asc')
            ->findAll();
        return view('admin/teacher/index', ["teachers"=>$teachers]);
    }

    public function create(){
        // TO DISPLAY CREATE TEACHER VIEW
        return view('admin/teacher/create');

    }

    public function store(){
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data= [
            "name"=>$this->request->getPost('name'),
            "nip"=>$this->request->getPost('nip'),
        ];

        $this->model->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('teacher.index');
    }

    public function edit($id)
    {
        // TO DISPLAY EDIT TEACHER VIEW
        $teacher = $this->model
            ->select('*')
            ->from('teacher as t')
            ->where('t.id', $id)
            ->first();

        return view('admin/teacher/edit', ["teacher" => $teacher]);
    }

    public function update($id)
    {
        $data = [
            "name" => $this->request->getPost('name'),
            "nip" => $this->request->getPost('nip'),
        ];

        $teacher = $this->model->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('teacher.index'));
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('teacher.index'));
    }
}
