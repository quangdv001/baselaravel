<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyHomeController extends MyBaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        return abort(404);
    }

    public function me(){
        $user = auth()->user();
        $res['success'] = 1;
        $res['data'] = $user;
        return response()->json($res, 200);
    }
}
