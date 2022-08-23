<?php

namespace App\Controllers\Cost;

use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Cost;
use App\Models\CostItem;
use App\Models\Unit;

class StartupController extends BaseController
{
    public function __construct()
    {
        $this->Cost = new Cost();
        $this->CostItem = new CostItem();
        $this->Category = new Category();
        $this->Unit = new Unit();
        $this->session = session();
    }

    public function index()
    {
        $category = $this->Category
            ->where('category_name', 'startup')
            ->first();

        $costs = $this->Cost
            ->select('cost.id, cost.necessity, cost.quantity, unit.unit_name, cost.description')
            ->select("(SELECT AVG(cost_item.quantity * cost_item.unit_price) FROM cost_item WHERE cost_item.cost_id = cost.id) as unit_price")
            ->join('unit', 'cost.unit_id = unit.id')
            ->where('category_id', $category["id"])
            ->findAll();
        return view('admin/cost/startup/index', ["costs" => $costs]);
    }

    public function create()
    {
        // TO DISPLAY CREATE COST VIEW
        return view('admin/cost/startup/create');
    }

    public function store()
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "category_id" => 2,
            "necessity" => $this->request->getPost('necessity'),
            "quantity" => $this->request->getPost('quantity'),
            "unit_id" => $this->request->getPost('unit_id'),
            "description" => $this->request->getPost('description'),
        ];

        $this->Cost->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('startup.index');
    }

    public function edit($id)
    {
        // TO DISPLAY EDIT COST VIEW
        $startup = $this->Cost
            ->select('*')
            ->from('cost as c')
            ->where('c.id', $id)
            ->first();

        $unit = $this->Unit->findAll();
        return view('admin/cost/startup/edit', ["item" => $startup, "units" => $unit]);
    }

    public function update($id)
    {
        // TO ACTUALLY UPDATE THE DATA TO DATABASE
        $data = [
            "necessity" => $this->request->getPost('necessity'),
            "quantity" => $this->request->getPost('quantity'),
            "unit_id" => $this->request->getPost('unit_id'),
            "description" => $this->request->getPost('description'),
        ];

        $startup = $this->Cost->where('id', $id)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('startup.index'));
    }

    public function delete($id)
    {
        // TO DELETE DATA FROM DATABASE
        $this->Cost->where('id', $id)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('startup.index'));
    }

    public function read($id)
    {
        $items = $this->CostItem
            ->select("
        cost_item.id, cost_item.detail,
        cost_item.quantity,
        unit.unit_name,
        cost_item.unit_price,
        cost_item.description,
        (cost_item.quantity * cost_item.unit_price) as total
        ")
            ->where('cost_id', $id)
            ->join('unit', 'cost_item.unit_id = unit.id')
            ->findAll();
        return view('admin/cost/startup/read', ["items" => $items, "startupId" => $id]);
    }

    public function itemCreate($id)
    {
        // TO DISPLAY CREATE COST VIEW
        return view('admin/cost/startup/item/create', ["costItemId" => $id]);
    }

    public function itemStore($id)
    {
        // TO ACTUALLY STORE THE DATA TO DATABASE
        // TODO: Validate Input
        $data = [
            "cost_id" => $id,
            "detail" => $this->request->getPost('detail'),
            "quantity" => $this->request->getPost('quantity'),
            "unit_id" => $this->request->getPost('unit_id'),
            "unit_price" => $this->request->getPost('unit_price'),
            "description" => $this->request->getPost('description'),
        ];

        $this->CostItem->insert($data);
        $message = "Data berhasil ditambahkan!";
        $this->session->setFlashdata('alert_success', $message);
        return redirect()->route('startup.read', [$id]);
    }

    public function itemEdit($id, $itemId)
    {
        // TO DISPLAY EDIT COST VIEW
        $itemStartup = $this->CostItem
            ->select('*')
            ->from('cost_item as ci')
            ->where('ci.id', $itemId)
            ->first();

        $unit = $this->Unit->findAll();
        return view('admin/cost/startup/item/edit', ["startupId" => $id, "items" => $itemStartup, "units" => $unit]);
    }

    public function itemUpdate($id, $itemId)
    {
        // TO ACTUALLY UPDATE THE DATA TO DATABASE
        $data = [
            "cost_id" => $id,
            "id" => $itemId,
            "detail" => $this->request->getPost('detail'),
            "quantity" => $this->request->getPost('quantity'),
            "unit_id" => $this->request->getPost('unit_id'),
            "unit_price" => $this->request->getPost('unit_price'),
            "description" => $this->request->getPost('description'),
        ];

        $itemStartup = $this->CostItem->where('id', $itemId)->set($data)->update();
        $message = "Data berhasil diubah!";
        $this->session->setFlashdata('alert', $message);
        return redirect()->to(route_to('startup.read', $id, $itemId));
    }

    public function itemDelete($id, $itemId)
    {
        // TO DELETE DATA FROM DATABASE
        $this->CostItem->where('id', $itemId)->delete();
        $this->session->setFlashdata('success', "Data berhasil dihapus!");
        return redirect()->to(route_to('startup.read', $id, $itemId));
    }
}
