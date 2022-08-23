<?php

namespace App\Controllers\Benefit;

use App\Controllers\BaseController;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Unit;

class TangibleController extends BaseController
{
    public function __construct()
    {
        $this->Benefit = new Benefit();
        $this->Category = new Category();
        $this->Unit = new Unit();
        $this->session = session();
    }

    public function index()
    {
        $category = $this->Category
            ->where('category_name', 'tangible')
            ->first();

        $benefits = $this->Benefit
            ->select('benefit.id, benefit.benefit, benefit.quantity, unit.unit_name, benefit.unit_price, (benefit.quantity * benefit.unit_price) as total, benefit.description')
            ->join('unit', 'benefit.unit_id = unit.id')
            ->where('category_id', $category["id"])
            ->findAll();
        return view('admin/benefit/tangible/index', ["benefits" => $benefits]);
    }

    public function create()
    {
        // TO DISPLAY CREATE BENEFIT VIEW
        return view('admin/benefit/tangible/create');
    }

    public function store()
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "category_id" => 5,
            "benefit" => $this->request->getPost('benefit'),
            "quantity" => $this->request->getPost('quantity'),
            "unit_id" => $this->request->getPost('unit_id'),
            "unit_price" => $this->request->getPost('unit_price'),
            "description" => $this->request->getPost('description'),
        ];

        $this->Benefit->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('tangible.index');
    }

    public function edit($id)
    {
        // TO DISPLAY EDIT BENEFIT VIEW
        $intangible = $this->Benefit
            ->select('*')
            ->from('benefit as b')
            ->where('b.id', $id)
            ->first();

        $unit = $this->Unit->findAll();
        return view('admin/benefit/tangible/edit', ["item" => $intangible, "units" => $unit]);
    }

    public function update($id)
    {
        $data = [
            "benefit" => $this->request->getPost('benefit'),
            "quantity" => $this->request->getPost('quantity'),
            "unit_id" => $this->request->getPost('unit_id'),
            "unit_price" => $this->request->getPost('unit_price'),
            "description" => $this->request->getPost('description'),
        ];

        $intangible = $this->Benefit->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('tangible.index'));
    }

    public function delete($id)
    {
        $this->Benefit->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('tangible.index'));
    }
}
