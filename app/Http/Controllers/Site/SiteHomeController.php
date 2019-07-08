<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;
use App\Services\OrderService;
use Illuminate\Support\Facades\App;
use Astrotomic\Translatable\Locales;

class SiteHomeController extends SiteBaseController
{
    private $category;
    private $article;
    private $order;
    private $locales;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article, OrderService $order, Locales $locales){
        parent::__construct();
        $this->category = $category;
        $this->article = $article;
        $this->order = $order;
        $this->locales = $locales;
    }

    public function index(){
        $paramTour['limit'] = 10;
        $paramTour['category_id'] = 2;
        $paramTour['status'] = 1;
        $tour = $this->article->search($paramTour);
        $paramArticle['limit'] = 4;
        $paramArticle['category_id'] = 1;
        $paramArticle['status'] = 1;
        $article = $this->article->search($paramArticle);
        return view('site.home.index')->with('tour', $tour)->with('article', $article);
    }

    public function sendContact(Request $request){
        $info = $request->all();
        // return response()->json($info);
        $mail = env('MAIL_ADMIN', 'quangdv001@gmail.com');
        Mail::to($mail)->send(new Contact($info));
        $res['success'] = 1;
        $res['mess'] = 'Gửi thành công';
        return response()->json($res);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        session(['locale' => $locale]);
        return $this->locales->current();
        // return redirect()->back();
        dd(session()->all());
    }

    public function currentLang(){
        return $this->locales->current();
    }
    

}
