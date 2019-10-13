<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\MaterialService;

class AdminProductController extends AdminBaseController
{
    protected $product;
    protected $category;
    protected $material;
    public function __construct(ProductService $product, CategoryService $category, MaterialService $material)
    {
        parent::__construct();
        $this->product = $product;
        $this->category = $category;
        $this->material = $material;
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
        $product = $productImg = $arrProductCombo = [];
        $listTag = '';
        if($id > 0){
            $product = $this->product->getById($id);
            $productImg = $this->product->getImg($id);
            $arrProductCombo = $this->product->getCombo($id)->pluck('product_id')->toArray();
        }
        $material = $this->material->getAll();
        $category = $this->category->getAll();
        $html = $this->category->generateOptionSelect($category, 0, $product ? $product->category_id : 0, '');
        $productCombo = $this->product->getProductCombo();
        return view('admin.product.edit')
            ->with('id', $id)
            ->with('productCombo', $productCombo)
            ->with('arrProductCombo', $arrProductCombo)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('productImg', $productImg)
            ->with('material', $material)
            ->with('data', $product);
    }

    public function postCreate(ProductRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'meta', 'type', 'description', 'status', 'category_id', 'img', 'price', 'color', 'material', 'material_id', 'width', 'height', 'depth', 'style', 'guarantee', 'is_combo');
        $dataCombo = $request->input('product_combo', []);
        $productImg = $request->input('product_img', []);
        $mess = '';
        if($id == 0){
            $res = $this->product->create($data);
            if($res){
                $this->product->createImg($res->id, $productImg);
                if($res->is_combo == 1){
                    $this->product->createCombo($res->id, $dataCombo);
                }
                $mess = 'Tạo sản phẩm thành công';
            }
        } else {
            $product = $this->product->getById($id);
            $res = $this->product->update($product, $data);
            if($res){
                $this->product->createImg($res->id, $productImg);
                if($res->is_combo == 1){
                    $this->product->createCombo($res->id, $dataCombo);
                }
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
