<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyBaseController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->user = auth()->user();
    }
}
