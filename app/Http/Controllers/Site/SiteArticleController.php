<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Astrotomic\Translatable\Locales;

class SiteArticleController extends SiteBaseController
{
    private $category;
    private $article;
    protected $locales;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article, Locales $locales){
        parent::__construct();
        $this->category = $category;
        $this->article = $article;
        $this->locales = $locales;
        $category = $this->category->getByParentId(0);
        View::share('category', $category);
    }

    public function index($id, $slug){
        $param['category_id'] = $id;
        $param['limit'] = 10;
        $param['sortBy'] = 'id';
        $article = $this->article->search($param);
        $cate = $this->category->getById($id);
        return view('site.article.index')
        ->with('cate', $cate)
        ->with('data', $article);
    }

    public function detail($id, $slug){
        $article = $this->article->getById($id);
        $cate = $this->category->getById($article->category_id);
        $param['category_id'] = $article->category_id;
        $param['except'] = $id;
        $param['limit'] = 1;
        $param['sortBy'] = 'id';
        $relateArticle = $this->article->search($param);
        return view('site.article.detail')
        ->with('relateArticle', $relateArticle)
        ->with('cate', $cate)
        ->with('data', $article);
    }

}
