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

    public function create(Request $request){
        $data['name'] = 'New Category';
        $category = $this->category->create($data);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($category){
            $res['success'] = 1;
            $res['mess'] = 'Tạo thành công.';
            $res['data'] = $category;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $data = $request->only('name', 'img', 'description', 'url', 'status');
        $category = $this->category->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($category){
            $response = $this->category->update($category, $data);
            if($response){
                $res['success'] = 1;
                $res['mess'] = 'Cập nhật thành công.';
                $res['data'] = $response;
            }
        }
        return response()->json($res); 
    }

    public function showCategories($categories, $parent_id = 0, $char = '')
    {
        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }
         
        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            echo '<ul>';
            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                echo '<li>'.$item['title'];
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                showCategories($categories, $item['id'], $char.'|---');
                echo '</li>';
            }
            echo '</ul>';
        }
    }

}
