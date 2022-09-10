<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;
use App\Utils\Calculator;

class IRR extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new BenefitValue();
        $this->model = new CostValue();
        $this->session = session();
        define("PRECISION", 0.00001);
    }

    public function index()
    {
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

        $irr = $this->IRR($cashflows);
        $npv = Calculator::NPV($cashflows, 50.4750);
        return view('admin/criteria/irr/index', ["costs" => $costs, "benefits" => $benefits, "length" => $length, "npv" => $npv, "irr"=>$irr]);
    }

    /**
     * $cashflows => dataset cashflow
     * 
     */
    public function IRR($cashflows, $top = 100, $bottom = -100, $pivot = 0, $decimal = false)
    {
        error_log("TOP $top, BOTTOM $bottom, GUESSING PIVOT $pivot");
        $leftTop = $pivot;
        $leftBottom = $bottom;


        $rightTop = $top;
        $rightBottom = $pivot;

        if ($decimal) {
            $leftPivot = $leftTop - (($leftTop - $leftBottom) / 2);
            $rightPivot = $rightTop - (($rightTop - $rightBottom) / 2);
        } else {
            $leftPivot = $leftTop - (round(($leftTop - $leftBottom) / 2));
            $rightPivot = $rightTop - (round(($rightTop - $rightBottom) / 2));
        }

        $left = Calculator::NPV($cashflows, $leftPivot);
        $right = Calculator::NPV($cashflows, $rightPivot);

        // TRIGGERS
        if (!$decimal) {
            if (abs($leftPivot - $rightPivot) < 1) {
                return $this->IRR($cashflows, ($pivot + 0.999), $pivot , ($pivot + (0.999 / 2)), true);
            }
        } else {
            if (abs($leftPivot - $rightPivot) < PRECISION) {
                return $pivot;
            }
        }

        // FAIL SAFE
        if($leftPivot > $top || $leftPivot < $bottom || $rightPivot > $top  || $rightPivot < $bottom){
            return $pivot;
        }
        
        if (abs($left) < abs($right)) {
                return $this->IRR($cashflows, $leftTop, $leftBottom, $leftPivot, $decimal);
        } else {
                return $this->IRR($cashflows, $rightTop, $rightBottom, $rightPivot, $decimal);
        }
    }
}
