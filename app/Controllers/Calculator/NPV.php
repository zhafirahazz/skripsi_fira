<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;

class NPV extends BaseController
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
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        return view('admin/criteria/npv/index', ["costs" => $costs, "benefits"=>$benefits]);
    }
}
