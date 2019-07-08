<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

class SiteBaseController extends Controller
{
    protected $currentRoute;
    protected $user;
    public function __construct()
    {
        $this->user = auth()->user();
        $this->currentRoute = Route::current()->getName();
        $pageClass = 'home';
        if($this->currentRoute == 'site.article.index'){
            $pageClass = 'category';
        } elseif($this->currentRoute == 'site.article.detail'){
            $pageClass = 'single';
        }
        // dd($this->currentRoute);
        View::share('currentRoute', $this->currentRoute);
        View::share('pageClass', $pageClass);
        View::share('user', $this->user);
    }

}
