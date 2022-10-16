<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Utils\Calculator;
use App\Models\Settings;

class PP extends BaseController
{

    public function __construct()
    {
        $this->settings =  new Settings();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);

        $pa = $this->settings
            ->where('key', 'pp.pa')
            ->first();

        return view('admin/criteria/pp/index', [
            "costs" => $costs,
            "benefits" => $benefits,
            "length" => $length,
            "pa" => $pa["value"]

        ]);
    }

    public function output()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $pp = Calculator::PP($costs, $benefits);

        $r = $this->settings
            ->where('key', 'pp.pa')
            ->first();

        $r['value'] = (int) $this->request->getVar("u");
        $this->settings->save($r);

        $tahun = floor($pp / 12);
        $bulan = $pp % 12;

        $kelayakan = $pp < ((int) $this->request->getVar("u") * 12) ? "LAYAK" : "TIDAK LAYAK";
        $message = "Nilai Payback Period adalah $tahun tahun $bulan bulan, maka proyek dinyatakan $kelayakan";


        $pp = "$tahun tahun $bulan bulan";

        return view('admin/criteria/pp/output', [
            "pp" => $pp,
            "message" => $message
        ]);
    }
}
