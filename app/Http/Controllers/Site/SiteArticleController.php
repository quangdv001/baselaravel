<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use App\Services\SocialsService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Astrotomic\Translatable\Locales;
use App\Services\PageService;
use Illuminate\Support\Facades\App;

class SiteArticleController extends SiteBaseController
{
    private $category;
    private $article;
    private $socials;
    protected $locales;
    private $page;
    
    // For only this view
    public function __construct(CategoryService $category, PageService $page, ArticleService $article, Locales $locales, SocialsService $socials){
        parent::__construct();
        $this->category = $category;
        $this->article = $article;
        $this->locales = $locales;
        $this->socials = $socials;
        $this->page = $page;
        $this->middleware(function($request,$next)
        {
            if (session()->has('locale')) {
                App::setLocale(session()->get('locale'));
            }
            return $next($request);
        });
        $category = $this->category->getByParentId(0);
        $paramArticle['limit'] = 4;
        $paramArticle['category_id'] = 1;
        $paramArticle['status'] = 1;
        $paramArticle['orderBy'] = 'id';
        $special_article = $this->article->search($paramArticle);
        $social_links = $this->socials->getAll();
        $social = [];
        foreach ($social_links as $v) {
            $social['$v->slug'] = $v->value;
        }
        $locale = session('locale');
        $list_page = $this->page->getAllByLocale($locale);
        $social = [];
        foreach ($social_links as $v) {
            if($locale == 'vi') {
                $social[$v->slug] = $v->value;    
            } else {
                $social[$v->slug] = $v->en_value;
            }
            
        }
        View::share('special_article', $special_article);
        View::share('social', $social);
        View::share('category', $category);
        View::share('list_page', $list_page);
    }

    public function index($id, $slug){
        $param['category_id'] = $id;
        $param['limit'] = 10;
        $param['sortBy'] = 'id';
        $article = $this->article->search($param);
        $cate = $this->category->getById($id);
        dd($cate);
        return view('site.article.index')
        ->with('cate', $cate)
        ->with('data', $article);
    }

    public function detail($id, $slug){
        $article = $this->article->getById($id);
        $cate = $this->category->getById($article->category_id);
        $param['category_id'] = $article->category_id;
        $param['except'] = $id;
        $param['limit'] = 6;
        $param['sortBy'] = 'id';
        $relateArticle = $this->article->search($param);
        return view('site.article.detail')
        ->with('relateArticle', $relateArticle)
        ->with('cate', $cate)
        ->with('data', $article);
    }

    public function price(){
        return view('site.article.price');
    }

    public function contact(){
        return view('site.article.contact');
    }

}
