<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;
use App\Models\BenefitValue;
use App\Models\CostValue;

class IRR extends BaseController
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
        $values = $this->model
        ->select('benefit_value.name_benefit, benefit_value.nominal')
        ->from('benefit_value')
        ->findAll();
    return view('admin/criteria/irr/index', ["values" => $values]);
    }
}
