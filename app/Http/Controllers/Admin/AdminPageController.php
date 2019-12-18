<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ArticleService;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\CategoryService;
use App\Services\PageService;

class AdminPageController extends AdminBaseController
{
    protected $page;
    private $arrType = [
        1 => 'Nhà đất',
        2 => 'Sàn giao dịch',
        3 => 'Đô thị',
        4 => 'Tin tức',
        5 => 'Pháp lý',
        7 => 'Trang nội dung',
        8 => 'Cách tính thuế đất',
        9 => 'Đối tác'
    ];
    public function __construct(PageService $page)
    {
        parent::__construct();
        $this->page = $page;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('id', 'title','status');
        $dataS['limit'] = 10;
        $article = $this->page->search($dataS);
        return view('admin.page.index')
            ->with('data', $article);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $article = [];
        if($id > 0){
            $article = $this->page->getById($id);
        }

        return view('admin.page.edit')
            ->with('id', $id)
            ->with('data', $article);
    }

    public function postCreate(Request $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'description', 'status');
        $mess = '';
        if($id == 0){
            $res = $this->page->create($data);
            if($res){
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $article = $this->page->getById($id);
            $res = $this->page->update($article, $data);
            if($res){
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.page.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->page->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.page.getList')->with('success_message', $mess);
    }

    public function loadPages($select = 0){
        $province = $this->page->list(['type' => 7], 'title', 'id');
        $res['success'] = 1;
        $res['mess'] = 'Lấy dữ liệu thành công!';
        $res['html'] = view('admin.province.optionProvince')->with('province', $province)->with('select', $select)->render();
        return response()->json($res);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
