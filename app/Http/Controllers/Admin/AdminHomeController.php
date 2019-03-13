<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHomeController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return view('admin.home.dashboard');
    }

}
