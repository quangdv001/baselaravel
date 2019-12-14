<?php

namespace App\Http\Controllers\Admin;

use App\Services\PageService;
use App\Services\SettingFooterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\SettingFooter\UpdateRequest;
use function PHPSTORM_META\type;

class AdminSettingFooterController extends AdminBaseController
{
    protected $settingFooterService;
    protected $pageService;

    private $arrType = [
        SettingFooterService::TYPE_TEXT => 'Text',
        SettingFooterService::TYPE_SINGLE_PAGE => 'Single page',
        SettingFooterService::TYPE_SOCIAL => 'Social',
        SettingFooterService::TYPE_IMAGE => 'Image',
    ];

    public function __construct(SettingFooterService $settingFooterService, PageService $pageService)
    {
        parent::__construct();
        $this->settingFooterService = $settingFooterService;
        $this->pageService = $pageService;
    }

    public function index()
    {
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message', 'Bạn không có quyền vào trang này!');
        }
        $list = $this->settingFooterService->get(['sortBy' => 'position', 'sortOrder' => 'ASC']);
        $html = $this->showCategories($list, 0, '');
        $listPage = $this->pageService->get([]);
        return view('admin.setting_footer.index')
            ->with('arrType', $this->arrType)
            ->with('listPage', $listPage)
            ->with('html', $html);
    }

    public function create()
    {
        $data['content'] = 'New Category Footer';
        $category = $this->settingFooterService->create($data);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if ($category) {
            $list = $this->settingFooterService->get(['sortBy' => 'position', 'sortOrder' => 'ASC']);
            $res['success'] = 1;
            $res['mess'] = 'Tạo thành công.';
            $res['data'] = $category;
            $res['html'] = $this->showCategories($list, 0, '');
        }
        return response()->json($res);
    }

    public function update(UpdateRequest $request, $id)
    {
        $data = $request->only('content', 'type', 'social', 'img', 'single_page_id', 'status');
        foreach ($data as $k => &$val) {
            if(!isset($val)){
                unset($data[$k]);
            }
            if(in_array($k,['type','status','single_page_id'])){
                $val= (int)$val;
            }
        }
        switch ($data['type']){
            case SettingFooterService::TYPE_TEXT:
                unset($data['img'],$data['social'],$data['single_page_id']);
                break;
            case SettingFooterService::TYPE_IMAGE:
                unset($data['social'],$data['single_page_id']);
                break;
            case SettingFooterService::TYPE_SINGLE_PAGE:
                unset($data['img'],$data['social']);
                break;
            case SettingFooterService::TYPE_SOCIAL:
                unset($data['img'],$data['single_page_id']);
                break;
        }
        $category = $this->settingFooterService->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if ($category) {
            $response = $this->settingFooterService->update($category, $data);
            if ($response) {
                $res['success'] = 1;
                $res['mess'] = 'Cập nhật thành công.';
                $res['data'] = $response;
            }
        }
        return response()->json($res);
    }

    public function updatePosition(Request $request)
    {
        $data = $request->input('data');
        $category = $this->generateCategory($data, 0);
        $response = $this->settingFooterService->updatePosition($category);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if ($response) {
            $list = $this->settingFooterService->get(['sortBy' => 'position', 'sortOrder' => 'ASC']);
            $res['success'] = 1;
            $res['mess'] = 'Cập nhật thành công.';
            $res['html'] = $this->showCategories($list, 0, '');
        }
        return response()->json($res);
    }

    public function show($id)
    {
        $category = $this->settingFooterService->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if ($category) {
            $res['success'] = 1;
            $res['mess'] = 'Cập nhật thành công.';
            $res['data'] = $category;
        }
        return response()->json($res);
    }

    public function remove($id)
    {
        $category = $this->category->delete($id);
        $res['success'] = 0;
        $res['mess'] = 'Mời xóa hoặc di chuyển danh mục con trước!';
        if ($category) {
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
        foreach ($categories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child) {
            $html .= '<ol class="dd-list">';
            foreach ($cate_child as $key => $item) {
                // Hiển thị tiêu đề chuyên mục
                $html .= '<li class="dd-item dd3-item" data-id="' . $item['id'] . '"><div class="dd-handle dd3-handle"></div>
                <div class="dd3-content">
                    <div class="pull-left">
                        <span class="text-category">' . $item['id'] . '-' . ($item['parent_id'] == 0 ? 'Group' : $item['content']) . '</span>
                    </div>
                    <div class="pull-right">'
                    . ($item['parent_id'] == 0 ? '' : '<a href="javascript:void(0);" class="text-warning mr-2 btn-edit" data-id="' . $item['id'] . '"><i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i></a>') . '
                        <a href="javascript:void(0);" class="text-danger rm_group_btn btn-rm" data-id="' . $item['id'] . '"><i class="fa fa-trash icon-sm" aria-hidden="true"></i></a>
                    </div>
                </div>';

                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $html .= $this->showCategories($categories, $item['id'], $char . '|---');
                $html .= '</li>';
            }
            $html .= '</ol>';
        } else {
            if ($parent_id == 0) {
                $html .= '<ol class="dd-list">';
                $html .= '</ol>';
            }
        }
        return $html;
    }

    public function generateCategory($arr, $parent = 0)
    {
        $data = $temp = [];
        if (sizeof($arr) > 0) {
            foreach ($arr as $k => $v) {
                $temp['id'] = $v['id'];
                $temp['position'] = $k;
                $temp['parent_id'] = $parent;
                $data[] = $temp;
                if (isset($v['children']) && sizeof($v['children']) > 0) {
                    $data = array_merge($data, $this->generateCategory($v['children'], $v['id']));
                }
            }
        }
        return $data;
    }

}
