<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\View;
use App\Services\ArticleService;
use App\Services\RoomService; 
use Illuminate\Support\Facades\Route;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    protected $currentRoute;
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

        $latestLaws = $this->article->latestByType(2);
        $headerNews = $this->article->latestByType(1);
        $latestNews = $this->article->latestByType(1);
        $latestProjects = $this->article->latestByType(3);
        $promotionNews = $this->article->latestByType(1);
        $partners = $this->article->latestByType(4);
        // dd($latestNews);
        $this->currentRoute = Route::current()->getName();
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
        $forRents = $this->roomService->search(['limit'=>5]);
        $promotionNews = $this->article->latestByType(0);
        return view('site.home.index')
            ->with('promotionNews', $promotionNews)
            ->with('forRents', $forRents);
    }

    public function show($slug){
        $article = $this->article->findArticleBySlug($slug);
        // dd($article);
        return view('site.home.single')
            ->with('slug', $slug)
            ->with('post', $article);
    }
    
    public function showCategory($slug){
        $articles = null;
        if (isset($slug) && $slug == 'for-rent')
        $articles = $this->roomService->getAll();
        // dd($article);
        return view('site.home.category')
            ->with('slug', $slug)
            ->with('posts', $articles);
    }

    public function showForRent($slug){
        if (isset($slug) && $slug != '')
        $article = $this->roomService->findBySlug($slug);
        // dd($article);
        return view('site.home.single-forRent')
            ->with('slug', $slug)
            ->with('post', $article);
    }

    public function showList($slug){
        if ($slug == 'for-rents') {
            $article = $this->roomService->search(['limit'=>10]);
            return view('site.category.index')
                ->with('category', (object)['type'=>4,'slug'=>'for-rents', 'name'=>'Cho thuê'])
                ->with('data', $article);
        }
        $category = $this->category->getBySlug($slug);
        $article = [];
        // dd($category);
        if(in_array($category->type, [1,2,3])){
            $article = $this->article->getListByCategory($category, 10);
        }
        // dd($article);
        return view('site.category.index')
            ->with('category', $category)
            ->with('data', $article);
    }

    public function showDetail($slugCategory, $slugDetail){
        if ($slugCategory === 'for-rents') {
            $article = $this->roomService->getBySlug($slugDetail);
            return view('site.category.detail_lord')
                ->with('category', (object)['type'=>4,'slug'=>'for-rents', 'name'=>'Cho thuê'])
                ->with('data', $article);
        }
        $category = $this->category->getBySlug($slugCategory);
        if(in_array($category->type, [1,2,3])){
            $article = $this->article->getBySlug($slugDetail);
            switch($category->type) {
                case 1: return view('site.category.detail_bds')
                            ->with('category', $category)
                            ->with('data', $article);
                        break;
                case 2: return view('site.category.detail_blog')
                            ->with('category', $category)
                            ->with('data', $article);
                        break;
                case 3: return view('site.category.detail_lord')
                            ->with('category', $category)
                            ->with('data', $article);
                        break;
                default:
                        break;
            }
        }
    }
}
