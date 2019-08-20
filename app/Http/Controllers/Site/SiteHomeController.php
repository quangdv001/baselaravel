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
use App\Services\ManagerService;
use App\Services\FooterService;
use App\Services\LandService;
use App\Services\ExchangeService;
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
    private $manager;
    private $footer;
    private $land;
    private $exchange;
    private $rental;
    private $room;
    public function __construct(CategoryService $category, ArticleService $article, RoomService $room, 
    ProvinceService $province, LawService $law, ProjectService $project, ManagerService $manager, FooterService $footer,
    LandService $land, ExchangeService $exchange){
        $this->category = $category;
        $this->article = $article;
        $this->law = $law;
        $this->project = $project;
        $this->province = $province;
        $this->manager = $manager;
        $this->footer = $footer;
        $this->land = $land;
        $this->exchange = $exchange;
        $this->room = $room;
        $categories = $this->category->getAll();
        $mainMenu = $this->category->getMenu($categories, 1);
        $topMenu = $this->category->getMenu($categories, 2);
        $socialMenu = $this->category->getMenu($categories, 3);
        $headerCenterMenu = $this->category->getMenu($categories, 4);

        // 
        $data = ['limit' => 10];
        $lastestLaws = $this->law->search($data);
        $lastestArticle = $this->article->latestByType(1, 10);
        $lastestLand = $this->land->search($data);
        $lastestExchange = $this->exchange->search($data);
        $latestProjects = $this->project->search($data);
        $latestRoom = $this->room->search($data);
        $promotionNews = $this->article->latestByType(1);
        $partners = $this->article->latestByType(4);
        $districts = $this->room->listPluck();
        $pagesFooter = $this->manager->getAll();
        $socialFooter = $this->footer->getAll();
        $this->currentRoute = Route::current()->getName();
        $listSocial = [];
        foreach($socialFooter as $v) {
            $listSocial[$v->code] = $v->value;
        }

        // Menu views
        View::share('categories', $categories);
        View::share('mainMenu', $mainMenu);
        View::share('topMenu', $topMenu);
        View::share('socialMenu', $socialMenu);
        View::share('headerCenterMenu', $headerCenterMenu);
        // Widget views
        View::share('lastestLaws', $lastestLaws);
        View::share('lastestLand', $lastestLand);
        View::share('lastestArticle', $lastestArticle);
        View::share('latestProjects', $latestProjects);
        View::share('lastestExchange', $lastestExchange);
        View::share('latestRoom', $latestRoom);
        View::share('promotionNews', $promotionNews);
        View::share('partners', $partners);
        View::share('districts', $districts);
        //Footer
        View::share('pagesFooter', $pagesFooter);
        View::share('listSocial', $listSocial);
    }

    public function index(){
        return view('site.home.index');
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
            $articles = $this->room->getAll();
        // dd($article);
        return view('site.home.category')
            ->with('slug', $slug)
            ->with('posts', $articles);
    }

    public function showForRent($slug){
        if (isset($slug) && $slug != '')
        $article = $this->room->findBySlug($slug);

        return view('site.home.single-forRent')
            ->with('slug', $slug)
            ->with('post', $article);
    }

    public function showList($slug){
        if ($slug == 'for-rents') {
            $article = $this->room->search(['limit'=>10]);
            return view('site.category.index')
                ->with('category', (object)['type'=>4,'slug'=>'for-rents', 'name'=>'Cho thuê'])
                ->with('data', $article);
        } elseif (in_array($slug, ['huong-dan', 'tai-lieu', 'chinh-sach', 'ho-tro', 'dieu-khoan-thoa-thuan'])) {
            $article = $this->manager->getBySlug($slug);
            return view('site.managerpage.index')
                ->with('data', $article);
        }
        $category = $this->category->getBySlug($slug);
        $arrDistrict = [];
        $data = [];
        $params = [];
        $view = '';
        $params['status'] = 1;
        $params['orderBy'] = 'id';
        $params['limit'] = 10;
        if($category->parent_id == 1) {
            switch($category->slug)
            {
                case "nha-dat-ha-noi":
                    $data = $this->land->search($params);
                    $view = 'site.category.article';
                    break;

                case "moi-gioi-san-giao-dich":
                    $data = $this->exchange->search($params);
                    $view = 'site.category.article';
                    break;

                case "cho-thue":
                    $arrDistrict = $this->province->getDistrictPluck()->toArray();
                    $data = $this->room->search($params);
                    $view = 'site.category.room';
                    break;
                
                case "tin-tuc":
                    $data = $this->article->search($params);
                    $view = 'site.category.article';
                    break;
                case "do-thi":
                    $data = $this->project->search($params);
                    $view = 'site.category.article';
                    break;
                case "tro-giup-phap-ly":
                    $data = $this->law->search($params);
                    $view = 'site.category.article';
                    break;
                default:
                    $view = 'site.category.article';
                    break;
            }
            $categoryChild = $this->category->getChild($category->id);
            return view($view)
                ->with('category', $category)
                ->with('categoryChild', $categoryChild)
                ->with('arrDistrict', $arrDistrict)
                ->with('data', $data);
        } elseif ($category->parent_id > 1) {
            $params['category_id'] = $category->id;
            $cate_parent = $this->category->getById($category->parent_id);
            switch($cate_parent->slug)
            {
                case "nha-dat-ha-noi":
                    $data = $this->land->search($params);
                    break;

                case "moi-gioi-san-giao-dich":
                    $data = $this->exchange->search($params);
                    break;
                
                case "tin-tuc":
                    $data = $this->article->search($params);
                    break;
                case "do-thi":
                    $data = $this->project->search($params);
                    break;
                case "tro-giup-phap-ly":
                    $data = $this->law->search($params);
                    break;
                default:
                    break;
            }
            $view = 'site.category.article';
            $categoryChild = $this->category->getChild($category->id);
            return view($view)
                ->with('category', $category)
                ->with('categoryChild', $categoryChild)
                ->with('arrDistrict', $arrDistrict)
                ->with('data', $data);
        }
        
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
            $data = $this->room->getBySlug($slugDetail);
            $relate = $this->room->getRelate($category->id, $slugDetail, 5);
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
        $arrDistrict = [];
        $response = [];
        // dd($params);
        $dataSearch = [
            'title'=> $params['q'],
            'status'=> 1
        ];
        if ((int) $params['t'] == 1){
            $response = $this->article->search($dataSearch);
            $view = 'site.category.search_article';
        } elseif((int) $params['t'] == 2){
            $response = $this->law->search($dataSearch);
            $view = 'site.category.search_article';
        } elseif((int) $params['t'] == 3){
            $response = $this->project->search($dataSearch);
            $view = 'site.category.search_article';
        } else {
            $arrDistrict = $this->province->getDistrictPluck()->toArray();
            $response = $this->room->search($dataSearch);
            $view = 'site.category.search_room';
        }

        return view($view)
        ->with('arrDistrict', $arrDistrict)
        ->with('data', $response)
        ->with('params', $params);

    }
}
