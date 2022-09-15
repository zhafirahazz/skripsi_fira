<?php

namespace App\Utils;

class Calculator
{
    public static function NPV($cashflows, $irr)
    {
        $npv = 0;
        foreach ($cashflows as $cashflow) {
            $temp = $cashflow["cashflow"] / pow((1 + ($irr / 100)), $cashflow["year"]);
            $npv = $npv + $temp;
        }
        return $npv;
    }


    public static function BCR($costs, $benefits, $rate)
    {
        $benefit = 0;
        foreach ($benefits as $key => $value) {
            $tmp = ($value->nominal / pow((1 + ($rate / 100)), $value->name_benefit));
            $benefit = $benefit + $tmp;
        }

        $cost = 0;
        foreach ($costs as $key => $value) {
            $tmp = ($value->price / pow((1 + ($rate / 100)), $value->name_cost));
            $cost = $cost + $tmp;
        }

        return ($benefit / $cost);
    }

    public static function ROI($cost, $profit)
    {
        return (($profit / $cost) * 100);
    }

    public static function IRR($cashflows, $top = 100, $bottom = -100, $pivot = 0, $decimal = false)
    {
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
                return Calculator::IRR($cashflows, ($pivot + 0.999), $pivot, ($pivot + (0.999 / 2)), true);
            }
        } else {
            if (abs($leftPivot - $rightPivot) < PRECISION) {
                return $pivot;
            }
        }

        // FAIL SAFE
        if ($leftPivot > $top || $leftPivot < $bottom || $rightPivot > $top  || $rightPivot < $bottom) {
            return $pivot;
        }

        if (abs($left) < abs($right)) {
            return Calculator::IRR($cashflows, $leftTop, $leftBottom, $leftPivot, $decimal);
        } else {
            return Calculator::IRR($cashflows, $rightTop, $rightBottom, $rightPivot, $decimal);
        }
    }

    public static function PP($costs, $benefits)
    {
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

            if ($b <= 0 && $same) {
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

        return $pp;
    }
}
