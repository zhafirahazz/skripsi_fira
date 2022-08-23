<?php

namespace App\Controllers\Value;

use App\Controllers\BaseController;
use App\Models\BenefitValue;

class BenefitValueController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BenefitValue();
        $this->session = session();
    }

    public function index()
    {
        $values = $this->model
        ->select('benefit_value.*')
            ->orderBy('benefit_value.name_benefit', 'asc')
            ->findAll();
        return view('admin/value/benefit/index', ["values" => $values]);
    }

    public function create()
    {
        // TO DISPLAY CREATE BENEFIT VALUE VIEW
        return view('admin/value/benefit/create');
    }

    public function store()
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "name_benefit" => $this->request->getPost('name'),
            "nominal" => $this->request->getPost('nominal'),
        ];

        $this->model->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('benefit_value.index');
    }

    public function edit($id)
    {
        // TO DISPLAY EDIT BENEFIT VALUE VIEW
        $value = $this->model
            ->select('*')
            ->from('benefit_value as bv')
            ->where('bv.id', $id)
            ->first();

        return view('admin/value/benefit/edit', ["value" => $value]);
    }

    public function update($id)
    {
        $data = [
            "name_benefit" => $this->request->getPost('name'),
            "nominal" => $this->request->getPost('nominal'),
        ];

        $value = $this->model->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('benefit_value.index'));
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('benefit_value.index'));
    }
}
