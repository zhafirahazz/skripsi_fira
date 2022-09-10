<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;

class PP extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits) ;
        return view('admin/criteria/pp/index', ["costs" => $costs, "benefits"=>$benefits, "length"=>$length]);
    }
}
