<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class AdminBaseController extends Controller
{
    protected $currentRoute;
    protected $currentParams;
    protected $user;
    public function __construct()
    {
        $this->user = auth('admin')->user();
        $this->currentRoute = Route::current()->getName();
        $this->currentParams = Route::current()->parameters();
        View::share('currentRoute', $this->currentRoute);
        View::share('currentParams', $this->currentParams);
        View::share('user', $this->user);
    }
}
