<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Utils\Calculator;

class PP extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);
        $pp = Calculator::PP($costs, $benefits);


        return view('admin/criteria/pp/index', [
            "costs" => $costs,
            "benefits" => $benefits,
            "length"=>$length,
            "pp"=>$pp
        ]);
    }

    public function output(){
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $pp = Calculator::PP($costs, $benefits);


        $kelayakan = $pp < (int) $this->request->getVar("u")? "LAYAK" : "TIDAK LAYAK";
        $message = "Nilai Payback Period adalah $pp tahun, maka proyek dinyatakan $kelayakan";

        return view('admin/criteria/pp/output', [
            "pp"=>$pp,
            "message"=>$message
        ]);
    }
}
