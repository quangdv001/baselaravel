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
use App\Services\ProvinceService;
use App\Http\Requests\Site\BookingRequest;
use Illuminate\Support\Facades\Storage;

class SiteHomeController extends SiteBaseController
{
    private $category;
    private $article;
    private $order;
    private $locales;
    private $province;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article, OrderService $order, Locales $locales, ProvinceService $province){
        parent::__construct();
        $this->category = $category;
        $this->article = $article;
        $this->order = $order;
        $this->locales = $locales;
        $this->province = $province;
        $paramArticle['limit'] = 4;
        $paramArticle['category_id'] = 1;
        $paramArticle['status'] = 1;
        $paramArticle['orderBy'] = 'id';
        $special_article = $this->article->search($paramArticle);
        View::share('special_article', $special_article);
    }

    public function index(){
        $paramTour['limit'] = 10;
        $paramTour['category_id'] = 2;
        $paramTour['status'] = 1;
        $paramTour['orderBy'] = 'id';
        $tour = $this->article->search($paramTour);
        $province = $this->province->getProvincePluck();
        return view('site.home.index')->with('tour', $tour)->with('province', $province);
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
        return redirect()->back();
    }

    public function currentLang(){
        return $this->locales->current();
    }

    public function booking(Request $request){
        // dd($request->all());
        $data = $request->only('start_id', 'end_id', 'qty', 'start_time', 'end_time', 'note', 'is_round_trip');
        // $data['is_round_trip'] = (int) $request->input('is_round_trip', 0);
        $province = $this->province->getProvincePluck();
        $paramArticle['limit'] = 6;
        $paramArticle['category_id'] = 1;
        $paramArticle['status'] = 1;
        $paramArticle['orderBy'] = 'id';
        $article = $this->article->search($paramArticle);
        return view('site.home.booking')->with('data', $data)->with('article', $article)->with('province', $province);
    }

    public function postBooking(BookingRequest $request){
        $province = $this->province->getProvincePluck()->toArray();
        $order = $request->only('payment_method');
        $orderDetail = $request->only('start_id', 'end_id', 'qty', 'start_time', 'end_time');
        $orderInfo = $request->only('note', 'name', 'email', 'phone', 'address');
        $orderDetail['is_round_trip'] = (int) $request->input('is_round_trip', 0);
        $orderDetail['start_name'] = $province[$orderDetail['start_id']];
        $orderDetail['end_name'] = $province[$orderDetail['end_id']];
        $orderDetail['start_time'] = strtotime($orderDetail['start_time']);
        $orderDetail['end_time'] = strtotime($orderDetail['end_time']);
        $resOrder = $this->order->create($order);
        if($resOrder){
            $orderDetail['order_id'] = $orderInfo['order_id'] = $resOrder->id;
            $resOrderDetail = $this->order->createOrderDetail($orderDetail);
            $resOrderInfo = $this->order->createOrderInfo($orderInfo);
        }
        return redirect()->route('site.home.index')->with('success_message', 'Đặt vé thành công!');
    }
    
    public function about(){
        $param['category_id'] = 1;
        $param['limit'] = 10;
        $param['sortBy'] = 'id';
        $article = $this->article->search($param);
        return view('site.home.about')->with('data', $article);
    }

    public function regulations(){
        $param['category_id'] = 1;
        $param['limit'] = 10;
        $param['sortBy'] = 'id';
        $article = $this->article->search($param);
        return view('site.home.regulations')->with('data', $article);
    }

    public function downloadFile($name){
        return Storage::download('upload/pdf/'.$name, $name);
    }

    public function gastation(){
        return view('site.home.gastation');
    }

    public function ticketLocation(){
        return view('site.home.ticket_location');
    }

}
