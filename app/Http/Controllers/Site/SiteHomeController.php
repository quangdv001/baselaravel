<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\View;
use App\Services\ArticleService;
use App\Services\LawService;
use App\Services\ProjectService;
use App\Services\RoomService; 
use Illuminate\Support\Facades\Route;
use App\Services\ProvinceService;
use App\Service\Extend\TelegramService;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    private $law;
    private $project;
    protected $currentRoute;
    // For only this view
    private $roomService;
    private $province;
    public function __construct(CategoryService $category, ArticleService $article, RoomService $roomService, ProvinceService $province, LawService $law, ProjectService $project){
        $this->category = $category;
        $this->article = $article;
        $this->law = $law;
        $this->project = $project;
        $this->roomService = $roomService;
        $this->province = $province;
        $categories = $this->category->getAll();
        $mainMenu = $this->category->getMenu($categories, 1);
        $topMenu = $this->category->getMenu($categories, 2);
        $socialMenu = $this->category->getMenu($categories, 3);
        $headerCenterMenu = $this->category->getMenu($categories, 4);

        $latestLaws = $this->law->getAll();
        $headerNews = $this->article->latestByType(1);
        $latestNews = $this->article->latestByType(1);
        $latestProjects = $this->project->getAll();
        $promotionNews = $this->article->latestByType(1);
        $partners = $this->article->latestByType(4);
        $districts = $this->roomService->listPluck();
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
        View::share('districts', $districts);
    }

    public function index(){
        $forRents = $this->roomService->search(['limit'=>5]);
        // $promotionNews = $this->article->latestByType(1);
        return view('site.home.index')
            // ->with('promotionNews', $promotionNews)
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
        $data = [];
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

    public function search(Request $request){
        $params = $request->only('t', 'q');
        $category = $this->category->getBySlug($params['t']);
        $arrDistrict = [];
        $response = [];
        $dataSearch = [
            'type'=> $params['t'],
            'title'=> $params['q'],
            'status'=> 1,
            'orderBy'=>'id'
        ];

        if (in_array($params['t'], ['tin_tuc', 'nha_dat', 'phap_luat'])){
            $response = $this->article->search($dataSearch);
            $view = 'site.category.search_article';
        } else {
            $arrDistrict = $this->province->getDistrictPluck()->toArray();
            $response = $this->roomService->search($dataSearch);
            $view = 'site.category.search_room';
        }

        return view($view)
        ->with('category', $category)
        ->with('arrDistrict', $arrDistrict)
        ->with('data', $response)
        ->with('keyword', $params['q']);

    }
}
