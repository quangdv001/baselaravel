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
    // For only this view
    private $roomService;
    public function __construct(CategoryService $category, ArticleService $article, RoomService $roomService){
        $this->category = $category;
        $this->article = $article;
        $this->roomService = $roomService;
        $categories = $this->category->getAll();
        $mainMenu = $this->category->getMenu($categories, 1);
        $topMenu = $this->category->getMenu($categories, 10);
        $socialMenu = $this->category->getMenu($categories, 13);
        $headerCenterMenu = $this->category->getMenu($categories, 16);

        $latestLaws = $this->article->latestByType(1);
        $headerNews = $this->article->latestByType(0);
        $latestNews = $this->article->latestByType(0);
        $latestProjects = $this->article->latestByType(2);
        $promotionNews = $this->article->latestByType(0);
        $partners = $this->article->latestByType(3);
        // Menu views
        View::share('categories', $categories);
        View::share('mainMenu', $mainMenu);
        View::share('topMenu', $topMenu);
        View::share('socialMenu', $socialMenu);
        View::share('headerCenterMenu', $headerCenterMenu);
        // Widget views
        View::share('latestLaws', $latestLaws);
        View::share('headerNews', $headerNews);
        View::share('latestNews', $latestNews);
        View::share('latestProjects', $latestProjects);
        View::share('promotionNews', $promotionNews);
        View::share('partners', $partners);
    }

    public function index(){
        $forRents = $this->roomService->getAll();
        $promotionNews = $this->article->latestByType(0);
        $partners = $this->article->latestByType(3);
        return view('site.home.index')
            ->with('promotionNews', $promotionNews)
            ->with('partners', $partners)
            ->with('forRents', $forRents);
    }
}
