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

    public static function IRR($cashflows)
    {
        $top = Calculator::FindNPVClosestToZero($cashflows, 0, 1000, false, true);
        $bottom = Calculator::FindNPVClosestToZero($cashflows, 0, 1000, false, false);
        $irr = $top["value"] + $top["npv"] / $top["npv"] - $bottom["npv"] * ($bottom["value"] - $top["value"]);
        return [
            "top" => $top,
            "bottom" => $bottom,
            "irr" => round($irr, 2)
        ];
    }

    public static function FindNPVClosestToZero($cashflows, $bottom = 0, $top = 100, $decimal = false, $positive = true)
    {
        if ($decimal) {
            $pivot = ($top + $bottom) / 2;
        } else {
            $pivot = floor(($top + $bottom) / 2);
        }

        $topNpv = Calculator::NPV($cashflows, $top);
        $pivotNpv = Calculator::NPV($cashflows, $pivot);
        $bottomNpv = Calculator::NPV($cashflows, $bottom);

        $topToZero = abs($topNpv - 0);
        $pivotToZero = abs($pivotNpv - 0);
        $bottomToZero = abs($bottomNpv - 0);

        $pivotToTop = abs($topToZero - $pivotToZero);
        $pivotTOBottom = abs($pivotToZero - $bottomToZero);

        error_log("top $top pivot $pivot bottom $bottom : $topNpv $pivotNpv $bottomNpv");
        error_log("pivotToTop $pivotToTop pivotToBottom $pivotTOBottom");

        if (abs($top - $bottom) < PRECISION) {
            if ($positive) {
                return $topNpv > 0 ? ["npv" => round($topNpv, 5), "value" => round($top, 2)] : ["npv" => round($bottomNpv, 5), "value" => round($bottom, 2)];
            } else {
                return $topNpv < 0 ? ["npv" => round($topNpv, 5), "value" => round($top, 2)] : ["npv" => round($bottomNpv, 5), "value" => round($bottom, 2)];
            }
        }

        if (($bottomNpv < 0 && 0 < $pivotNpv)) {
            return Calculator::FindNPVClosestToZero($cashflows, $bottom, $pivot, true, $positive);
        } else if ($pivotNpv < 0 && 0 < $topNpv) {
            return Calculator::FindNPVClosestToZero($cashflows, $pivot, $top, true, $positive);
        } else if ($topNpv < 0 && 0 < $pivotNpv) {
            return Calculator::FindNPVClosestToZero($cashflows, $pivot, $top, true, $positive);
        } else {
            return Calculator::FindNPVClosestToZero($cashflows, $bottom, $pivot, true, $positive);
        }
    }

    public static function PP($costs, $benefits)
    {
        $length = sizeof($costs) > sizeof($benefits) ? sizeof($costs) : sizeof($benefits);

        $cashflows = [];
        $n = 0;
        $tmp = null;
        $b = 0;
        $same = true;
        $nIndex = null;
        $a = $costs[0]->price;
        for ($i = 0; $i < $length; $i++) {
            $cashflow = $benefits[$i]->nominal - $costs[$i]->price;
            error_log($cashflow);


            if ($nIndex == null) {
                if (($b + $cashflow) >= 0) {
                    $nIndex = $i - 1;
                    $n = $costs[$i - 1]->name_cost;
                } else {
                    $b = $b + $cashflow;
                }
            }
            if ($nIndex != null) {
                if ($tmp == null) {
                    $tmp = $cashflows[$i - 1];
                } else {
                    if ($tmp != $cashflow) {
                        $same = false;
                    }
                    $tmp = $cashflow;
                }
            }

            $cashflow = [
                "cashflow" => $cashflow,
                "year" => $costs[$i]->name_cost
            ];
            array_push($cashflows, $cashflow);
        }

        if (sizeof($costs) <= ($nIndex + 1) || sizeof($benefits) <= ($nIndex + 1)) {
            $c = null;
        } else {
            $c = ($benefits[$nIndex + 1]->nominal - $costs[$nIndex + 1]->price);
        }

        $b = $benefits[$nIndex]->nominal - $costs[$nIndex]->price;
        $c = $c + $b;

        if ($same) {
            $pp = $a / ($benefits[$nIndex]->nominal - $costs[$nIndex]->price) * 12;
        } else {
            $pp = ($n * 12) + ((($a - $b) / ($c - $b)) * 12);
        }


        return floor($pp);
    }
}
