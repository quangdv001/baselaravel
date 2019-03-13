<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AdminBaseController extends Controller
{
    protected $currentRoute;
    protected $user;
    public function __construct()
    {
        $this->user = auth()->user();
        $this->currentRoute = Route::current()->getName();
        View::share('currentRoute', $this->currentRoute);
        View::share('user', $this->user);
    }
}
