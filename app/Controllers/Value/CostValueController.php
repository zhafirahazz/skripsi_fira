<?php

namespace App\Controllers\Value;

use App\Controllers\BaseController;
use App\Models\CostValue;

class CostValueController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CostValue();
        $this->session = session();
    }

    public function index()
    {
        $values = $this->model
            ->select('cost_value.*')
            ->orderBy('cost_value.name_cost', 'asc')
            ->findAll();
        return view('admin/value/cost/index', ["values" => $values]);
    }

    public function create()
    {
        // TO DISPLAY CREATE COST VALUE VIEW
        return view('admin/value/cost/create');
    }

    public function store()
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "name_cost" => $this->request->getPost('name'),
            "price" => $this->request->getPost('price'),
        ];

        $this->model->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('cost_value.index');
    }

    public function edit($id)
    {
        // TO DISPLAY EDIT COST VALUE VIEW
        $value = $this->model
            ->select('*')
            ->from('cost_value as cv')
            ->where('cv.id', $id)
            ->first();

        return view('admin/value/cost/edit', ["value" => $value]);
    }

    public function update($id)
    {
        $data = [
            "name_cost" => $this->request->getPost('name'),
            "price" => $this->request->getPost('price'),
        ];

        $value = $this->model->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('cost_value.index'));
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('cost_value.index'));
    }
}
