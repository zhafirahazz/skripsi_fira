<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;
use App\Utils\Calculator;

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

    public function output(){
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);
        $cashflows = [];

        for ($i = 0; $i < $length; $i++) {
            $cashflow = $benefits[$i]->nominal - $costs[$i]->price;
            $cashflow = [
                "cashflow" => $cashflow,
                "year" => $costs[$i]->name_cost
            ];
            array_push($cashflows, $cashflow);
        }

        $npv= Calculator::NPV($cashflows, (int) $this->request->getVar("r"));

        $kelayakan = $npv > 0 ? "DITERIMA" : "TIDAK DITERIMA";
        $message = "Nilai NPV adalah $npv maka proyek $kelayakan ";

        return view('admin/criteria/npv/output',[
            "npv"=>$npv,
            "message"=>$message
        ]);
    }
}
