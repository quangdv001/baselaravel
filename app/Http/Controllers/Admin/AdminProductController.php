<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Http\Requests\Admin\ProductRequest;

class AdminProductController extends AdminBaseController
{
    protected $product;
    protected $category;
    public function __construct(ProductService $product, CategoryService $category)
    {
        parent::__construct();
        $this->product = $product;
        $this->category = $category;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('title','type','status', 'ids');
        $dataS['limit'] = 10;
        $product = $this->product->search($dataS);
        $listCategories = $this->category->listPluck();

        return view('admin.product.index')
            ->with('data', $product)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $product = $productImg = [];
        $listTag = '';
        if($id > 0){
            $product = $this->product->getById($id);
            $productImg = $this->product->getImg($id);
        }

        $category = $this->category->getAll();
        $html = $this->category->generateOptionSelect($category, 0, $product ? $product->category_id : 0, '');
        return view('admin.product.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('productImg', $productImg)
            ->with('data', $product);
    }

    public function postCreate(ProductRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'meta', 'type', 'description', 'status', 'category_id', 'img', 'price', 'color', 'material');
        $productImg = $request->input('product_img', []);
        $mess = '';
        if($id == 0){
            $res = $this->product->create($data);
            if($res){
                $this->product->createImg($res->id, $productImg);
                $mess = 'Tạo sản phẩm thành công';
            }
        } else {
            $product = $this->product->getById($id);
            $res = $this->product->update($product, $data);
            if($res){
                $this->product->createImg($res->id, $productImg);
                $mess = 'Cập nhật sản phẩm thành công';
            }
        }
        return redirect()->route('admin.product.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->product->remove($id);
        $mess = 'Xóa sản phẩm thành công';
        return redirect()->route('admin.product.getList')->with('success_message', $mess);
    }

}
