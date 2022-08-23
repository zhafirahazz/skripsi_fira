<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Benefit;
use App\Models\Category;
use App\Models\Cost;
use App\Models\CostItem;

class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->Cost = new Cost();
        $this->Benefit = new Benefit();
        $this->CostItem = new CostItem();
        $this->Category = new Category();
    }
    //

    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT category.category_display as display,
        (SELECT SUM(cost.quantity * (SELECT AVG(cost_item.quantity * cost_item.unit_price) FROM `cost_item` WHERE cost_item.cost_id = cost.id)) as price
        FROM `cost` WHERE cost.category_id = category.id) as total
        FROM `category` WHERE category.category_name IN ('procurement', 'startup', 'project_related', 'ongoing')")->getResult();
        return view('admin/dashboard', ["cost" => $query]);
    }
}
