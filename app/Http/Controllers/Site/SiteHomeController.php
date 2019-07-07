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

class SiteHomeController extends SiteBaseController
{
    private $category;
    private $article;
    private $order;
    
    // For only this view
    public function __construct(CategoryService $category, ArticleService $article, OrderService $order){
        parent::__construct();
        $this->category = $category;
        $this->article = $article;
        $this->order = $order;
        $category = $this->category->getByParentId(0);
        View::share('category', $category);
    }

    public function index(){
        $params['status'] = 1;
        $params['type'] = 1;
        $params['sortBy'] = 'id';
        $params['sortOrder'] = 'ASC';
        $category = $this->category->search($params);
        if(sizeof($category) > 0){
            foreach($category as $v){
                $param['category_id'] = $v->id;
                $param['limit'] = 10;
                $param['sortBy'] = 'id';
                $v->article = $this->article->search($param);
            }
        }
        return view('site.home.index')->with('cate', $category);
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

    public function order(){
        return view('site.home.order');
    }

    public function orderDetail(Request $request){
        $id = $request->input('id', 0);
        $order = $this->order->getById($id);
        // dd($order);
        return view('site.home.orderDetail')
        ->with('id', $id)
        ->with('data', $order);
    }
}
