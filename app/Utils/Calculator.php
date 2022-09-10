<?php

namespace App\Utils;

class Calculator{
    public static function NPV($cashflows, $irr)
    {
        $npv = 0;
        foreach ($cashflows as $cashflow) {
            $temp = $cashflow["cashflow"] / pow((1+($irr/100)), $cashflow["year"]);
            $npv = $npv + $temp;
        }
        return $npv;
    }


}