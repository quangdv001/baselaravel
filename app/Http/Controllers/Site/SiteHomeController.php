<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use App\Services\AdvertiseService;
use App\Services\RoomService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Mail\Contact;
use Illuminate\Support\Facades\Mail;

class SiteHomeController extends Controller
{
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article, AdvertiseService $advertise, RoomService $room){
        $this->category = $category;
        $this->article = $article;
        $this->advertise = $advertise;
        $this->room = $room;
    }

    public function index(){
        //nhà đất hà nội
        $list_article_lands = $this->article->search(['category_id'=>1, 'limit'=>9, 'status'=>1]);
        //môi giới - sàn giao dịch
        $list_article_exchanges = $this->article->search(['category_id'=> 2, 'limit'=>5, 'status'=>1]);
        //đô thị
        $list_article_projects = $this->article->search(['category_id'=> 3, 'limit'=>5, 'status'=>1]);
        //tin tức
        $list_article_news = $this->article->search(['category_id'=> 4, 'limit'=>10, 'status'=>1]);
        //pháp lý
        $list_article_laws = $this->article->search(['category_id'=> 5, 'limit'=>10, 'status'=>1]);
        //cách tính thuế đất
        $list_article_tax = $this->article->search(['category_id'=> 8, 'limit'=>5, 'status'=>1]);
        //đối tác
        $list_partner = $this->article->search(['category_id'=> 10, 'limit'=>5, 'status'=>1]);
        //quảng cáo dọc
        $advertise_vertical = $this->advertise->search(['position'=> 1, 'limit'=>5, 'status'=>1]);
        //quảng cáo ngang
        $advertise_horizontal = $this->advertise->search(['position'=> 2, 'limit'=>5, 'status'=>1]);
        //cho thuê
        $list_article_rooms = $this->room->search(['limit'=>10, 'status'=>1]);

        $exchangesMerge = json_decode(json_encode($list_article_exchanges), true);
        $partnersMerge = json_decode(json_encode($list_partner), true);
        $exchangePartner = array_merge($exchangesMerge['data'], $partnersMerge['data']);
        return view('site.home.index')
                ->with('list_article_lands', $list_article_lands)
                ->with('list_article_projects', $list_article_projects)
                ->with('list_article_news', $list_article_news)
                ->with('list_article_laws', $list_article_laws)
                ->with('list_article_tax', $list_article_tax)
                ->with('advertise_vertical', $advertise_vertical)
                ->with('advertise_horizontal', $advertise_horizontal)
                ->with('exchangePartner', $exchangePartner)
                ->with('list_article_rooms', $list_article_rooms);
    }
}
