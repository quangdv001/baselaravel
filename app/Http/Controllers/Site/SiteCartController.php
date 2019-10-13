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
use App\Services\ProductService;
use Cart;
use App\Services\OrderService;
use Illuminate\Support\Carbon;
use App\Mail\OrderNew;

class SiteCartController extends SiteBaseController
{
    private $category;
    private $product;
    private $order;
    
    // For only this view
    public function __construct(CategoryService $category, ProductService $product, OrderService $order){
        parent::__construct();
        $this->category = $category;
        $this->product = $product;
        $this->order = $order;
        $category = $this->category->getByParentId(0);
        View::share('category', $category);
    }

    public function index(){
        $cart = Cart::content();
        return view('site.cart.index')->with('data', $cart);
    }

    public function add($id, Request $request){
        $product = $this->product->getById($id);
        // return response($product);
        
        $res['success'] = 0;
        if($product){
            $content = Cart::content();
            if($product->is_combo == 0){
                $check = 0;
                foreach($content as $v){
                    if($v->id == $id){
                        $check = 1;
                    }
                }
                
                if($check == 0){
                    Cart::add([
                        'id' => $product->id, 
                        'name' => $product->title, 
                        'qty' => 1, 
                        'price' => $product->price, 
                        'weight' => 1, 
                        'options' => ['img' => $product->img, 
                                    'category' => $product->category->name, 
                                    'type' => $product->type, 
                                    'width' => $product->width, 
                                    'depth' => $product->depth, 
                                    'height' => $product->height
                                    ]
                        ]);
                    $count = Cart::count();
                    $content = Cart::content();
                    $res['success'] = 1;
                    $res['mess'] = 'Thêm sản phẩm vào giỏ hàng thành công';
                    $res['html'] = view('site.cart.cart')->with('data', $content)->with('count', $count)->render();
                } else {
                    $res['mess'] = 'Sản phẩm đã có trong giỏ hàng';
                }
            } else {
                $productCombo = $this->product->getCombo($product->id);
                if(sizeof($productCombo) > 0){
                    foreach($productCombo as $prods){
                        $content = Cart::content();
                        $prod = $prods->product;
                        $check = 0;
                        foreach($content as $v){
                            if($v->id == $id){
                                $check = 1;
                            }
                        }
                        
                        if($check == 0){
                            Cart::add([
                                'id' => $prod->id, 
                                'name' => $prod->title, 
                                'qty' => 1, 
                                'price' => $prod->price, 
                                'weight' => 1, 
                                'options' => ['img' => $prod->img, 
                                            'category' => $prod->category->name, 
                                            'type' => $prod->type, 
                                            'width' => $prod->width, 
                                            'depth' => $prod->depth, 
                                            'height' => $prod->height
                                            ]
                                ]);
                            $count = Cart::count();
                            $content = Cart::content();
                            $res['success'] = 1;
                            $res['mess'] = 'Thêm sản phẩm vào giỏ hàng thành công';
                            $res['html'] = view('site.cart.cart')->with('data', $content)->with('count', $count)->render();
                        } else {
                            $res['mess'] = 'Sản phẩm đã có trong giỏ hàng';
                        }
                    }
                }
            }
            
        }
        
        return response()->json($res);
    }

    public function remove($rowId){
        Cart::remove($rowId);
        $count = Cart::count();
        $content = Cart::content();
        $res['success'] = 1;
        $res['mess'] = 'Xóa thành công';
        $res['html'] = view('site.cart.cart')->with('data', $content)->with('count', $count)->render();
        return response()->json($res);
    }

    public function destroy(){
        Cart::destroy();
    }

    public function payment(){
        $cart = Cart::content();
        $isActive = auth()->check() ? auth()->user()->status : 0;
        $total = Cart::subtotal();
        return view('site.cart.payment')
        ->with('isActive', $isActive)
        ->with('total', $total)
        ->with('data', $cart);
    }

    public function update(Request $request, $id, $qty){
        $isActive = auth()->check() ? auth()->user()->status : 0;
        $product = $this->product->getById($id);
        $content = Cart::content();
        $rowId = '';
        foreach($content as $k => $v){
            if($v->id == $id){
                $rowId = $k;
            }
        }
        $data = $request->all();
        Cart::update($rowId, ['qty' => floatval($qty), 'options' => ['width' => $data['width'], 
                                                                'height' => $data['height'], 'depth' => $data['depth'], 'img' => $product->img, 
                                                                'category' => $product->category->name, 
                                                                'type' => $product->type, ]]);
        $count = Cart::count();
        $content = Cart::content();
        $total = $isActive ? Cart::subtotal()*0.9 : Cart::subtotal();
        $res['success'] = 1;
        $res['mess'] = 'Cập nhật thành công';
        $res['html'] = view('site.cart.cart')->with('data', $content)->with('count', $count)->render();
        return response()->json($res);
    }

    public function submitOrder(Request $request){
        $isActive = auth()->check() ? auth()->user()->status : 0;
        $data = $request->all();

        $content = Cart::content();
        $count = Cart::count();
        $orderDetail = [];
        $time = Carbon::now();

        $res['success'] = 0;

        $data['users_id'] = auth()->check() ? $this->user->id : 0;
        $order['status'] = 1;
        $order['total'] = Cart::subtotal(0, '', '');
        if($isActive){
            $data['name'] = $this->user->name;
            $data['email'] = $this->user->email;
            $data['phone'] = $this->user->phone;
            $order['total'] = $order['total']*0.9;
        }
        $resOrder = $this->order->create($order);
        if($resOrder){
            $data['order_id'] = $resOrder->id;
            $orderInfo = $this->order->createOrderInfo($data);
        } else {
            $res['mess'] = 'Lỗi tạo đơn hàng';
            return response()->json($res);
        }
        
        if($count > 0){
            foreach($content as $k => $v){
                $orderDetail[$k]['order_id'] = $resOrder->id;
                $orderDetail[$k]['product_id'] = $v->id;
                $orderDetail[$k]['title'] = $v->name;
                $orderDetail[$k]['img'] = $v->options->img;
                $orderDetail[$k]['width'] = $v->options->width ? $v->options->width : 0;
                $orderDetail[$k]['height'] = $v->options->height ? $v->options->height : 0;
                $orderDetail[$k]['depth'] = $v->options->depth ? $v->options->depth : 0;
                $orderDetail[$k]['qty'] = $v->qty;
                $orderDetail[$k]['price'] = $v->price;
                $orderDetail[$k]['total'] = $v->subtotal;
                $orderDetail[$k]['created_at'] = $time;
            }
            $resDetail = $this->order->createOrderDetail(array_values($orderDetail));
        }
        Cart::destroy();
        $newOrder = $this->order->getById($resOrder->id);
        Mail::to($data['email'])->send(new OrderNew($newOrder));
        $res['success'] = 1;
        $res['mess'] = 'Tạo đơn hàng thành công';
        return response()->json($res);
    }
}
