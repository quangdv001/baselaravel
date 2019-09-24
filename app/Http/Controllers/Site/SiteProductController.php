<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ArticleService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Services\ProductService;

class SiteProductController extends SiteBaseController
{
    private $product;
    private $article;
    protected $currentRoute;
    
    // For only this view
    public function __construct(CategoryService $category, ProductService $product){
        parent::__construct();
        $this->category = $category;
        $this->product = $product;
        $category = $this->category->getByParentId(0);
        View::share('category', $category);
    }

    public function index($id, $slug){
        $cate = $this->category->getById($id);
        if ($id == 3) {
            $listCategoriesChild = $this->category->getByParentId($id);
            return view('site.product.categories')
            ->with('cate', $cate)
            ->with('listCateChild', $listCategoriesChild);
        }
        $param['category_id'] = $id;
        $param['limit'] = 12;
        $param['sortBy'] = 'id';
        $product = $this->product->search($param);
        
        return view('site.product.index')
        ->with('cate', $cate)
        ->with('data', $product);
    }

    public function detail($id){
        $product = $this->product->getById($id);
        $res['html'] = view('site.product.detail')->with('data', $product)->render();
        return response()->json($res);
    }

}
