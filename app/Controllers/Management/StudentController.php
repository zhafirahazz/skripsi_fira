<?php

namespace App\Controllers\Management;

use App\Controllers\BaseController;
use App\Models\ClassStudent;
use App\Models\Student;

class StudentController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new Student();
        $this->ClassStudent = new ClassStudent();
        $this->session = session();
    }

    public function index()
    {
        $students = $this->model
        ->select('student.*, class.class_display')
            ->orderBy('student.name','asc')
            ->join('class','student.class_id = class.id')
            ->findAll();
        return view('admin/student/index', ["students"=>$students]);
    }

    public function create(){
        // TO DISPLAY CREATE STUDENT VIEW
        return view('admin/student/create');
    }

    public function store(){
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data= [
            "name"=>$this->request->getPost('name'),
            "class_id"=>$this->request->getPost('class'),
        ];

        $this->model->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('student.index');
    }

    public function edit($id)
    {
        // TO DISPLAY EDIT STUDENT VIEW
        $student = $this->model
            ->select('*')
            ->from('student as s')
            ->where('s.id', $id)
            ->first();

        $classes = $this->ClassStudent->findAll();
        return view('admin/student/edit', ["student" => $student, "classes" => $classes]);
    }

    public function update($id)
    {
        $data = [
            "name" => $this->request->getPost('name'),
            "class_id" => $this->request->getPost('class_id'),
        ];

        $student = $this->model->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('student.index'));
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('student.index'));
    }
}
