<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;

class ROI extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new BenefitValue();
        $this->model = new CostValue();
        $this->session = session();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT SUM(price) as price FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT SUM(nominal) as nominal FROM benefit_value ORDER BY name_benefit")->getResult();
        return view('admin/criteria/roi/index', [
            "costs" => $costs[0]? $costs[0] : null,
            "benefits" => $benefits[0]? $benefits[0] : null
        ]);
    }
}
