<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\View;
use App\Services\ArticleService;
use App\Services\RoomService;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    private $roomService;
    public function __construct(CategoryService $category, ArticleService $article, RoomService $roomService){
        $this->category = $category;
        $this->article = $article;
        $categories = $this->category->getAll();
        $mainMenu = $this->category->getMenu($categories, 1);
        $topMenu = $this->category->getMenu($categories, 10);
        $socialMenu = $this->category->getMenu($categories, 13);
        $headerCenterMenu = $this->category->getMenu($categories, 16);
        View::share('categories', $categories);
        View::share('mainMenu', $mainMenu);
        View::share('topMenu', $topMenu);
        View::share('socialMenu', $socialMenu);
        View::share('headerCenterMenu', $headerCenterMenu);
    }

    public function index(){
        $forRents = $this->roomService ? $this->roomService->getAll() : [];
        dd($forRents);
        return view('site.home.index')
            ->with(['forRents'=>$forRents]);
    }
}
