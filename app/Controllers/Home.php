<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('template/index');
    }

    public function index2()
    {
        return view('user_group/index');
    }
}
