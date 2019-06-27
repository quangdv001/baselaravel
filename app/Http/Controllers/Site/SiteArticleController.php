<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class SiteArticleController extends Controller
{
    private $category;
    private $article;
    protected $currentRoute;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article){
        $this->category = $category;
        $this->article = $article;
        $category = $this->category->getAll();
        View::share('category', $category);
    }

    public function index(){
        $params['status'] = 1;
        $params['type'] = 1;
        $category = $this->category->search($params);
        if(sizeof($category) > 0){
            foreach($category as $v){
                $param['category_id'] = $v->id;
                $param['limit'] = 10;
                $param['sortBy'] = 'id';
                $v->article = $this->article->search($param);
            }
        }
        dd($category);
        return view('site.home.index')->with('cate', $category);
    }
}
