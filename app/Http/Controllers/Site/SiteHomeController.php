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
        $mainMenu = $this->category->getMenu($categories, 1);
        $topMenu = $this->category->getMenu($categories, 10);
        $socialMenu = $this->category->getMenu($categories, 13);
        $headerCenterMenu = $this->category->getMenu($categories, 16);
        // $menu = $this->category->genMenu($categories, 1);
        // dd($categories);
        View::share('categories', $categories);
        View::share('mainMenu', $mainMenu);
        View::share('topMenu', $topMenu);
        View::share('socialMenu', $socialMenu);
        View::share('headerCenterMenu', $headerCenterMenu);
    }

    public function index(){
        
        return view('site.home.index');
    }
}
