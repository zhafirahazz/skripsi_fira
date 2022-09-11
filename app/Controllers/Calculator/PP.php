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
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);

        $cashflows = [];
        $n = 0;
        $tmp = 0;
        $b = 0;
        $same = true;
        $nIndex = 0;
        $a = $costs[0]->price;
        for ($i = 0; $i < $length; $i++) {
            $cashflow = $benefits[$i]->nominal - $costs[$i]->price;
            // init tmp
            if ($i == 0) {
                $tmp = $cashflow;
            }

            if ($b <= 0) {
                $b = $b + $cashflow;
                $n = $costs[$i]->name_cost;
                $nIndex = $i;
            }

            if ($cashflow != $tmp && $same) {
                $same = false;
            }

            // set tmp to current cashflow to compare next
            $tmp = $cashflow;


            $cashflow = [
                "cashflow" => $cashflow,
                "year" => $costs[$i]->name_cost
            ];
            array_push($cashflows, $cashflow);
        }

        if (sizeof($costs) <= ($nIndex + 1) || sizeof($benefits) <= ($nIndex + 1)) {
            $c = null;
        } else {
            $c = ($benefits[$nIndex + 1]->nominal - $costs[$nIndex + 1]->price) + $b;
        }



        if ($same) {
            $pp = $a / ($benefits[$nIndex]->nominal - $costs[$nIndex]->price);
        } else {
            $pp = $n + (($a - $b) / ($c - $b));
        }

        return view('admin/criteria/pp/index', [
            "costs" => $costs,
            "benefits" => $benefits,
            "length" => $length,
            "n" => $n,
            "cn" => $tmp,
            "b" => $b,
            "same" => $same,
            "a" => $a,
            "c" => $c,
            "pp" => $pp,
            "nIndex"=>$nIndex
        ]);
    }
}
