<?php

namespace App\Controllers\Calculator;

use App\Controllers\BaseController;

class PP extends BaseController
{
    public function index()
    {
        return view('admin/criteria/pp/index', ['title'=>'PP']);
    }
}
