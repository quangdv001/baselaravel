<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;

class AdminCategoryController extends AdminBaseController
{
    protected $category;
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->category = $categoryService;
    }

    public function index(Request $request){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        return view('admin.category.index');
    }

}
