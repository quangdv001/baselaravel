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
use App\Services\SocialsService;
use App\Services\SliderService;
use App\Services\PageService;
use App\Services\ImageService;
use App\Http\Requests\Site\BookingRequest;
use App\Mail\OrderNew;
use Illuminate\Support\Facades\Storage;

class SiteHomeController extends SiteBaseController
{
    private $category;
    private $article;
    private $order;
    private $locales;
    private $province;
    private $socials;
    private $sliders;
    private $page;
    private $image;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article, OrderService $order, PageService $page,
                                Locales $locales, ProvinceService $province, SocialsService $socials, SliderService $sliders, ImageService $image){
        parent::__construct();
        $this->middleware(function($request,$next)
        {
            if (session()->has('locale')) {
                App::setLocale(session()->get('locale'));
            }
            return $next($request);
        });
        $this->category = $category;
        $this->article = $article;
        $this->order = $order;
        $this->locales = $locales;
        $this->province = $province;
        $this->socials = $socials;
        $this->sliders = $sliders;
        $this->page = $page;
        $this->image = $image;
        $paramArticle['limit'] = 4;
        $paramArticle['category_id'] = 1;
        $paramArticle['status'] = 1;
        $paramArticle['orderBy'] = 'id';
        $special_article = $this->article->search($paramArticle);
        $list_sliders = $this->sliders->getAll();
        $social_links = $this->socials->getAll();
        $train_no = ['SE1', 'SE3', 'SE19', 'SE2', 'SE4', 'SE20',
                     'SP1', 'SP2', 'SNT1', 'SNT2', 'SE22', 'SE21'];
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
        View::share('list_sliders', $list_sliders);
        View::share('list_page', $list_page);
        View::share('train_no', $train_no);
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
        $data = $request->only('start_id', 'end_id', 'qty', 'start_time', 'end_time', 'train_no', 'is_round_trip');
        $train_no = ['SE1', 'SE3', 'SE19', 'SE2', 'SE4', 'SE20',
                     'SP1', 'SP2', 'SNT1', 'SNT2', 'SE22', 'SE21'];
        $province = $this->province->getProvincePluck();
        $paramArticle['limit'] = 6;
        $paramArticle['category_id'] = 1;
        $paramArticle['status'] = 1;
        $paramArticle['orderBy'] = 'id';
        $article = $this->article->search($paramArticle);
        return view('site.home.booking')->with('data', $data)
                                        ->with('article', $article)
                                        ->with('province', $province)
                                        ->with('train_no', $train_no);
    }

    public function postBooking(BookingRequest $request){
        $province = $this->province->getProvincePluck()->toArray();
        $order = $request->only('payment_method');
        $orderDetail = $request->only('start_id', 'end_id', 'qty', 'start_time', 'end_time', 'train_no');
        $orderInfo = $request->only('note', 'name', 'email', 'phone', 'address');
        $orderDetail['is_round_trip'] = (int) $request->input('is_round_trip', 0);
        if ($orderDetail['is_round_trip'] == 1) {
            $this->validate($request, [
                'end_time' => 'required',
            ], [
                'end_time.required' => 'Mời chọn ngày về (please choose return date! thank you!)',
            ]);
            $orderDetail['end_time'] = strtotime($orderDetail['end_time']);
        }
        $orderDetail['start_name'] = $province[$orderDetail['start_id']];
        $orderDetail['end_name'] = $province[$orderDetail['end_id']];
        $orderDetail['start_time'] = strtotime($orderDetail['start_time']);
        
        $resOrder = $this->order->create($order);
        if($resOrder){
            $orderDetail['order_id'] = $orderInfo['order_id'] = $resOrder->id;
            $resOrderDetail = $this->order->createOrderDetail($orderDetail);
            $resOrderInfo = $this->order->createOrderInfo($orderInfo);
        }
        $mail = env('MAIL_ADMIN', 'quangdv001@gmail.com');
        Mail::to($mail)->send(new OrderNew($resOrder));
        return redirect()->back()->with('success_message', 'Create ticket success! We will connect to you to confirm. Thanks!');
    }
    
    public function about(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
        $param['sortBy'] = 'id';
        $data = $this->page->getById(3);
        // if($this->locales->current() == 'en') {
        //     $data = $this->page->getBySlug('about-us');
        // } else{
        //     $data = $this->page->getBySlug('ve-chung-toi');
        // }
        
        $article = $this->article->search($param);

        return view('site.home.about')->with('article', $article)->with('data', $data);
    }

    public function journeysFare(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
        $param['sortBy'] = 'id';
        if($this->locales->current() == 'en') {
            $data = $this->page->getBySlug('journeys-fare');
        } else{
            $data = $this->page->getBySlug('hanh-trinh-gia-ve');
        }
        
        $article = $this->article->search($param);

        return view('site.home.journeys')->with('article', $article)->with('data', $data);
    }

    public function imageAlbum(){
        $images = $this->image->getAll();

        return view('site.home.album_image')->with('images', $images)->with('locate', $this->locales->current());
    }

    public function customer_care(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
        $param['sortBy'] = 'id';
        $data = $this->page->getById(7);
        // if($this->locales->current() == 'en') {
        //     $data = $this->page->getBySlug('customer-care');
        // } else{
        //     $data = $this->page->getBySlug('cham-soc-khac-hang');
        // }
        
        $article = $this->article->search($param);

        return view('site.home.customer_care')->with('article', $article)->with('data', $data);
    }

    public function faqs(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
        $param['sortBy'] = 'id';
        $data = $this->page->getById(4);
        // if($this->locales->current() == 'en') {
        // } else{
        //     $data = $this->page->getBySlug('hoi-dap');
        // }
        
        $article = $this->article->search($param);

        return view('site.home.faqs')->with('article', $article)->with('data', $data);
    }

    public function shipping_policy(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
        $param['sortBy'] = 'id';
        $data = $this->page->getById(5);
        // if($this->locales->current() == 'en') {
        //     $data = $this->page->getBySlug('shipping-policy');
        // } else{
        //     $data = $this->page->getBySlug('chinh-sach-van-chuyen');
        // }
        
        $article = $this->article->search($param);

        return view('site.home.shipping_policy')->with('article', $article)->with('data', $data);
    }

    public function payment_guide(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
        $param['sortBy'] = 'id';
        $data = $this->page->getById(6);
        // if($this->locales->current() == 'en') {
        //     $data = $this->page->getBySlug('payment-guide');
        // } else{
        //     $data = $this->page->getBySlug('huong-dan-thanh-toan');
        // }
        
        $article = $this->article->search($param);

        return view('site.home.payment_guide')->with('article', $article)->with('data', $data);
    }

    public function regulations(){
        $param['category_id'] = 1;
        $param['limit'] = 5;
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
