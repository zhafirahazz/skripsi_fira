<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;
use App\Utils\Calculator;
use App\Models\Settings;

class IRR extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new BenefitValue();
        $this->model = new CostValue();
        $this->session = session();
        define("PRECISION", 0.00001);
        $this->settings =  new Settings();


    }

    public function index()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);


        $rr = $this->settings
            ->where('key', 'irr.rr')
            ->first();



        $cashflows = [];

        for ($i = 0; $i < $length; $i++) {
            $cashflow = $benefits[$i]->nominal - $costs[$i]->price;
            $cashflow = [
                "cashflow" => $cashflow,
                "year" => $costs[$i]->name_cost
            ];
            array_push($cashflows, $cashflow);
        }

        return view('admin/criteria/irr/index', [
            "costs" => $costs,
            "benefits" => $benefits,
            "length" => $length,
            "rr" => $rr['value']
        ]);
    }

    public function output()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);

        $cashflows = [];

        $r = $this->settings
        ->where('key', 'irr.rr')
        ->first();

        $r['value'] = (int) $this->request->getVar("r");
        $this->settings->save($r);

        for ($i = 0; $i < $length; $i++) {
            $cashflow = $benefits[$i]->nominal - $costs[$i]->price;
            $cashflow = [
                "cashflow" => $cashflow,
                "year" => $costs[$i]->name_cost
            ];
            array_push($cashflows, $cashflow);
        }
        $irr = Calculator::IRR($cashflows);
        $kelayakan = (int) $this->request->getVar("r") < $irr ? "LAYAK" : "TIDAK LAYAK";
        $message = "Nilai IRR adalah $irr% maka proyek $kelayakan untuk di lanjutkan";
        return view('admin/criteria/irr/output', ["irr" => $irr, "message" => $message]);
    }
}
