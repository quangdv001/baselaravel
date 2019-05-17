<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\View;
use App\Services\ArticleService;
use App\Services\RoomService; 
use Illuminate\Support\Facades\Route;
use App\Services\ProvinceService;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    protected $currentRoute;
    // For only this view
    private $roomService;
    private $province;
    public function __construct(CategoryService $category, ArticleService $article, RoomService $roomService, ProvinceService $province){
        $this->category = $category;
        $this->article = $article;
        $this->roomService = $roomService;
        $this->province = $province;
        $categories = $this->category->getAll();
        $mainMenu = $this->category->getMenu($categories, 1);
        $topMenu = $this->category->getMenu($categories, 2);
        $socialMenu = $this->category->getMenu($categories, 3);
        $headerCenterMenu = $this->category->getMenu($categories, 4);

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
        $arrDistrict = [];
        // dd($arrDistrict);
        $data = [];
        // dd($category);
        $view = '';
        if(in_array($category->type, [1,2,3])){
            $params['status'] = 1;
            $params['type'] = $category->type;
            $params['orderBy'] = 'id';
            $params['limit'] = 10;
            $data = $this->article->search($params);
            $view = 'site.category.article';
        } elseif($category->type == 4){
            $arrDistrict = $this->province->getDistrictPluck()->toArray();
            $params['status'] = 1;
            $params['orderBy'] = 'id';
            $params['limit'] = 10;
            $data = $this->roomService->search($params);
            $view = 'site.category.room';
        }
        // dd($arrDistrict);
        return view($view)
            ->with('category', $category)
            ->with('arrDistrict', $arrDistrict)
            ->with('data', $data);
    }

    public function showDetail($slugCategory, $slugDetail){
        $category = $this->category->getBySlug($slugCategory);
        $view = '';
        $arrDistrict = $arrProvince = $arrWard = [];
        if(in_array($category->type, [1,2,3])){
            $data = $this->article->getBySlug($slugDetail);
            $relate = $this->article->getRelate($category->id, $slugDetail, 5);
            $view = 'site.details.article';
        } else {
            $arrProvince = $this->province->getProvincePluck()->toArray();
            $arrDistrict = $this->province->getDistrictPluck()->toArray();
            $arrWard = $this->province->getWardPluck()->toArray();
            $data = $this->roomService->getBySlug($slugDetail);
            $relate = $this->roomService->getRelate($category->id, $slugDetail, 5);
            $view = 'site.details.room';
        }
        return view($view)
            ->with('arrProvince', $arrProvince)
            ->with('arrDistrict', $arrDistrict)
            ->with('arrWard', $arrWard)
            ->with('category', $category)
            ->with('relate', $relate)
            ->with('data', $data);
    }
}
