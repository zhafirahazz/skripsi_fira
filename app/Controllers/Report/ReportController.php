<?php

namespace App\Controllers\Report;

use App\Controllers\BaseController;
use App\Utils\Calculator;
use App\Models\Settings;
use App\Models\User;

class ReportController extends BaseController
{

    public function __construct()
    {
        $this->settings = new Settings();
        define("PRECISION", 0.01);
        $this->user = new User();
    }

    public function index()
    {

        $db = \Config\Database::connect();
        $costs = $db->query("SELECT * FROM cost_value ORDER BY name_cost")->getResult();
        $benefits = $db->query("SELECT * FROM benefit_value ORDER BY name_benefit")->getResult();
        $settings = $this->settings
            ->find();


        $bcrr = $this->findSettings($settings, 'bcr.r');
        $bcr = Calculator::BCR($costs, $benefits, $bcrr["value"]);
        $kesimpulan = $bcr >= 1 ? "LAYAK" : "TIDAK LAYAK";
        $messageBCR = "Nilai BCR adalah $bcr maka project $kesimpulan untuk dilanjutkan";

        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);
        $cashflows = [];
        $totalCost = 0;
        $totalBenefit = 0;

        for ($i = 0; $i < $length; $i++) {
            $totalCost = $totalCost + $costs[$i]->price;
            $totalBenefit =  $totalBenefit + $benefits[$i]->nominal;
            $cashflow = $benefits[$i]->nominal - $costs[$i]->price;
            $cashflow = [
                "cashflow" => $cashflow,
                "year" => $costs[$i]->name_cost
            ];
            array_push($cashflows, $cashflow);
        }

        $npv = Calculator::NPV($cashflows, (float) $this->findSettings($settings, 'npv.r'));
        $kelayakanNPV = $npv > 0 ? "DITERIMA" : "TIDAK DITERIMA";
        $messageNPV = "Nilai NPV adalah $npv maka proyek $kelayakanNPV ";


        $irr = Calculator::IRR($cashflows)["irr"];
        $rr = $this->findSettings($settings, 'irr.rr')["value"];
        $kelayakanIRR =  $rr < $irr ? "LAYAK" : "TIDAK LAYAK";
        $messageIRR = "Nilai IRR adalah $irr% (batas : $rr%) maka proyek $kelayakanIRR untuk di lanjutkan";

        $pp = Calculator::PP($costs, $benefits);
        $pa = $this->findSettings($settings, 'pp.pa')["value"];
        $kelayakanPP = $pp < ($pa * 12) ? "LAYAK" : "TIDAK LAYAK";

        $costsROI = $db->query("SELECT SUM(price) as price FROM cost_value ORDER BY name_cost")->getResult();
        $benefitsROI = $db->query("SELECT SUM(nominal) as nominal FROM benefit_value ORDER BY name_benefit")->getResult();

        $roi = Calculator::ROI($costsROI[0]->price, ($benefitsROI[0]->nominal - $costsROI[0]->price));

        $kelayakanROI = $roi > 0 ? "LAYAK" : "TIDAK LAYAK";
        $messageROI = "Nilai Payback Period adalah $roi %, maka proyek dinyatakan $kelayakanROI untuk dilanjutkan";

        $kepsek = $this->user->where('role_id', 2)->first();

        $admin = session()->get('name');

        if (session()->get('role') != 1) {
            $user = $this->user->where('role_id', 1)->first();
            $admin = $user["name"];
        }
        $tahun = floor($pp/12);
        $bulan = $pp % 12;
        $ppString = "$tahun tahun $bulan bulan";
        $messagePP = "Nilai Payback Period adalah $ppString (usia proyek $pa tahun), maka proyek dinyatakan $kelayakanPP untuk dilanjutkan";


        return view('admin/report/index', [
            "tc" => $totalCost,
            "tb" => $totalBenefit,
            "cashflows" => $cashflows,
            "costs" => $costs,
            "benefits" => $benefits,
            "length" => $length,
            "bcrr" => $bcrr["value"],
            "bcr" => $bcr,
            "messageBCR" => $messageBCR,
            "npv" => $npv,
            "npvr" => $this->findSettings($settings, 'npv.r')["value"],
            "messageNPV" => $messageNPV,
            "irr" => $irr,
            "messageIRR" => $messageIRR,
            "pp" => $ppString,
            "messagePP" => $messagePP,
            "roi" => $roi,
            "costROI" => $costsROI,
            "benefitROI" => $benefitsROI,
            "messageROI" => $messageROI,
            "kepsek" => $kepsek["name"],
            "admin" => $admin
        ]);
    }

    private function findSettings($settings, $key)
    {
        foreach ($settings as $setting) {
            if ($setting["key"] == $key) {
                return $setting;
            }
        }

        return null;
    }
}
