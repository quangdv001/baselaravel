<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    protected $currentRoute;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article){
        $this->category = $category;
        $this->article = $article;
        $categories = $this->category->getByParentId(0);
        $limit = 5;
        $articleProject = $this->article->getListByCategory(4, $limit);
        $articleDesign = $this->article->getListByCategory(3, $limit);
        $this->currentRoute = Route::current()->getName();
        // Menu views
        View::share('categories', $categories);
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
            $response = $this->roomService->search($dataSearch);
            $view = 'site.category.search_room';
        }

        return view($view)
        ->with('arrDistrict', $arrDistrict)
        ->with('data', $response)
        ->with('params', $params);

    }
}
