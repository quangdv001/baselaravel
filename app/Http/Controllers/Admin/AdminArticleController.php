<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ArticleService;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\CategoryService;

class AdminArticleController extends AdminBaseController
{
    protected $article;
    protected $category;
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
    public function __construct(ArticleService $article, CategoryService $category)
    {
        parent::__construct();
        $this->article = $article;
        $this->category = $category;
    }

    public function index(Request $request, $type){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('id', 'title','status', 'category_id', 'user_name_c','admin_name_c');
        $dataS['type'] = $type;
        $dataS['limit'] = 10;
        $article = $this->article->search($dataS);
        $category = $this->category->get(['type' => $type]);
        $listCategories = $category->pluck('name', 'id')->toArray();
        $html = $this->category->generateOptionSelect($category->toArray(), 0, isset($dataS['category_id']) ? $dataS['category_id'] : 0, '');
        return view('admin.article.index')
            ->with('data', $article)
            ->with('html', $html)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($type, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $article = $tagItem = $articleImg = [];
        $listTag = '';
        if($id > 0){
            $article = $this->article->getById($id);
            $articleImg = $article->images;
        }

        $category = $this->category->get(['type' => $type])->toArray();
        $html = $this->category->generateOptionSelect($category, 0, $article ? $article->category_id : 0, '');
        return view('admin.article.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('articleImg', $articleImg)
            ->with('data', $article)
            ->with('type', $type);
    }

    public function postCreate(ArticleRequest $request, $type, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'short_description', 'description', 'status', 'category_id', 'img', 'file_path');
        $data['type'] = $type;
        $articleImg = $request->input('article_img', []);
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            
            $res = $this->article->create($data);
            if($res){
                $this->article->createArticleImg($res->id, $articleImg);
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $article = $this->article->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->article->update($article, $data);
            if($res){
                $this->article->createArticleImg($res->id, $articleImg);
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.article.getList', $type)->with('success_message', $mess);
    }

    public function remove($type, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->article->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.article.getList', $type)->with('success_message', $mess);
    }

    public function loadPages($select = 0){
        $province = $this->article->list(['type' => 7], 'title', 'id');
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
