<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteArticleController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(){
        return view('site.article.index');
    }

    public function detail(){
        return view('site.article.detail');
    }
}
