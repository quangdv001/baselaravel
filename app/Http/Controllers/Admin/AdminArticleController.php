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
    public function __construct(ArticleService $article, CategoryService $category)
    {
        parent::__construct();
        $this->article = $article;
        $this->category = $category;
    }

    public function index(Request $request){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('title','type','status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        $article = $this->article->search($dataS);
        $listCategories = $this->category->listPluck();

        return view('admin.article.index')
            ->with('data', $article)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $response = [];
        if($id > 0){
            $response = $this->article->getById($id);
        }

        $category = $this->category->getAll();
        $html = $this->category->generateOptionSelect($category, 0, $response ? $response->category_id : 0, '');
        return view('admin.article.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('data', $response);
    }

    public function postCreate(ArticleRequest $request, $id = 0){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'meta', 'type', 'short_description', 'description', 'status', 'category_id');
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            $res = $this->article->create($data);
            if($res){
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $admin = $this->article->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->article->update($admin, $data);
            if($res){
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.article.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->article->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.article.getList')->with('success_message', $mess);
    }


}
