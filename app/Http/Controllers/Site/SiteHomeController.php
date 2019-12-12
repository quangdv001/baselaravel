<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class SiteHomeController extends Controller
{
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article){
    }

    public function index(){
        return view('site.home.index');
    }
}
