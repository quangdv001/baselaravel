<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;

class AdminCategoryController extends AdminBaseController
{
    protected $category;
    private $arrType = [
        0 => 'Theo Url',
        1 => 'Nhà đất',
        2 => 'Sàn giao dịch',
        3 => 'Đô thị',
        4 => 'Tin tức',
        5 => 'Pháp lý',
        6 => 'Cho thuê',
        7 => 'Trang nội dung',
    ];
    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();
        $this->category = $categoryService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $category = $this->category->getAll();
        $html = $this->showCategories($category, 0, '');
        return view('admin.category.index')
            ->with('arrType', $this->arrType)
            ->with('html', $html);
    }

    public function create(Request $request){
        $data['name'] = 'New Category';
        $data['status'] = 1;
        $data['position'] = 0;
        $category = $this->category->create($data);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($category){
            $list = $this->category->getAll();
            $res['success'] = 1;
            $res['mess'] = 'Tạo thành công.';
            $res['data'] = $category;
            $res['html'] = $this->showCategories($list, 0, '');
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $data = $request->only('name', 'img', 'description', 'url', 'status', 'type', 'class_name', 'article_id');
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

    public function updatePosition(Request $request){
        $data = $request->input('data');
        $category = $this->generateCategory($data, 0);
        $response = $this->category->updatePosition($category);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($response){
            $res['success'] = 1;
            $res['mess'] = 'Cập nhật thành công.';
        }
        return response()->json($res);
    }

    public function show($id){
        $category = $this->category->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($category){
            $res['success'] = 1;
            $res['mess'] = 'Cập nhật thành công.';
            $res['data'] = $category;
        }
        return response()->json($res);
    }

    public function remove($id){
        $category = $this->category->delete($id);
        $res['success'] = 0;
        $res['mess'] = 'Mời xóa hoặc di chuyển danh mục con trước!';
        if($category){
            $res['success'] = 1;
            $res['mess'] = 'Xóa thành công.';
            $res['data'] = $category;
        }
        return response()->json($res);
    }

    public function showCategories($categories, $parent_id = 0, $char = '')
    {
        $html = '';
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
            $html .= '<ol class="dd-list">';
            foreach ($cate_child as $key => $item)
            {
                // Hiển thị tiêu đề chuyên mục
                $html .= '<li class="dd-item dd3-item" data-id="'.$item['id'].'"><div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <div class="pull-left">
                        <span class="text-category">'.$item['id'].'-'.$item['name'].'</span>
                    </div>
                    <div class="pull-right">
                        <a href="javascript:void(0);" class="text-warning mr-2 btn-edit" data-id="'.$item['id'].'"><i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i></a>
                        <a href="javascript:void(0);" class="text-danger rm_group_btn btn-rm" data-id="'.$item['id'].'"><i class="fa fa-trash icon-sm" aria-hidden="true"></i></a>
                    </div>
                </div>';
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $html .= $this->showCategories($categories, $item['id'], $char.'|---');
                $html .= '</li>';
            }
            $html .= '</ol>';
        } else {
            if($parent_id == 0){
                $html .= '<ol class="dd-list">';
                $html .= '</ol>';
            }
        }
        return $html;
    }

    public function generateCategory($arr, $parent = 0){
        $data = $temp = [];
        if(sizeof($arr) > 0){
            foreach($arr as $k => $v){
                $temp['id'] = $v['id'];
                $temp['position'] = $k;
                $temp['parent_id'] = $parent;
                $data[] = $temp;
                if(isset($v['children']) && sizeof($v['children']) > 0){
                    $data = array_merge($data,$this->generateCategory($v['children'], $v['id']));
                }
            }
        }
        return $data;
    }

}
