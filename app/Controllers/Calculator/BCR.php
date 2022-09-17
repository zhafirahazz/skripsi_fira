<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;
use App\Models\Settings;
use App\Utils\Calculator;

class BCR extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new BenefitValue();
        $this->model = new CostValue();
        $this->session = session();
        $this->settings =  new Settings();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $bcrr = $this->settings
            ->where('key', 'bcr.r')
            ->first();

        return view('admin/criteria/bcr/index', ["costs" => $costs, "benefits" => $benefits, 'r' => $bcrr['value']]);
    }



    public function output()
    {
        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $bcrr = $this->settings
        ->where('key', 'bcr.r')
        ->first();

        $bcrr['value'] = (int) $this->request->getVar("r");
        $this->settings->save($bcrr);

        $bcr = Calculator::BCR($costs, $benefits, (int) $this->request->getVar("r"));
        $kesimpulan = $bcr >= 1 ? "LAYAK" : "TIDAK LAYAK";

        $message = "Nilai BCR adalah $bcr maka project $kesimpulan untuk dilanjutkan";
        return view('admin/criteria/bcr/output', ["bcr" => $bcr, "message" => $message]);
    }
}
