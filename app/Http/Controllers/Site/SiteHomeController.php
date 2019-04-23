<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\View;
use App\Services\ArticleService;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    public function __construct(CategoryService $category, ArticleService $article){
        $this->category = $category;
        $this->article = $article;
        $categories = $this->category->getAll();
        $menu = $this->category->getMenu($categories, 1);
        // $menu = $this->category->genMenu($categories, 1);
        View::share('categories', $categories);
        View::share('menu', $menu);
    }

    public function index(){
        
        return view('site.home.index');
    }
}
