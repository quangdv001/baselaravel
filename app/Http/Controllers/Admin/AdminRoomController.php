<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ArticleService;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\CategoryService;
use App\Services\RoomService;
use App\Http\Requests\Admin\RoomRequest;

class AdminRoomController extends AdminBaseController
{
    private $room;
    private $category;
    public function __construct(RoomService $room, CategoryService $category)
    {
        parent::__construct();
        $this->room = $room;
        $this->category = $category;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('id', 'title','type','status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        $room = $this->room->search($dataS);
        $category = $this->category->get(['type' => 6]);
        $listCategories = $category->pluck('name', 'id')->toArray();
        

        return view('admin.room.index')
            ->with('data', $room)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $article = $articleImg = [];
        if($id > 0){
            $article = $this->room->getById($id);
            $articleImg = $article->images;
        }

        $category = $this->category->get(['type' => 6])->toArray();
        $html = $this->category->generateOptionSelect($category, 0, $article ? $article->category_id : 0, '');
        return view('admin.room.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('articleImg', $articleImg)
            ->with('data', $article);
    }

    public function postCreate(RoomRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'type_name', 'short_description', 'description', 'price', 'acreage', 'direction', 'province_id', 
                                'district_id', 'ward_id', 'address', 'status', 'category_id', 'img', 'tag', 'file_path');
        $articleImg = $request->input('article_img', []);
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            
            $res = $this->room->create($data);
            if($res){
                $this->room->createArticleImg($res->id, $articleImg);
                $mess = 'Tạo phòng trọ thành công';
            }
        } else {
            $article = $this->room->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->room->update($article, $data);
            if($res){
                $this->room->createArticleImg($res->id, $articleImg);
                $mess = 'Cập nhật phòng trọ thành công';
            }
        }
        return redirect()->route('admin.room.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->room->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.room.getList')->with('success_message', $mess);
    }


}
