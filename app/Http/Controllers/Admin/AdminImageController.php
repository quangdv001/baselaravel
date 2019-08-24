<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ImageService;
use App\Http\Requests\Admin\ImageRequest;
use Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\App;

class AdminImageController extends AdminBaseController
{
    protected $image;
    public function __construct(ImageService $image, Locales $locales)
    {
        parent::__construct();
        $this->image = $image;
        $this->locales = $locales;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }

        $image = $this->image->getAll();

        return view('admin.image.index')
            ->with('data', $image);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $image = [];
        if($id > 0){
            $image = $this->image->getById($id);
        }
        return view('admin.image.edit')
            ->with('id', $id)
            ->with('data', $image);
    }

    public function postCreate(ImageRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('image', 'content_en', 'content_vi');
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            $res = $this->image->create($data);
            if($res){
                $mess = 'Tạo ảnh thành công';
            }
        } else {
            $image = $this->image->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->image->update($image, $data);
            if($res){
                $mess = 'Cập nhật ảnh thành công';
            }
        }
        return redirect()->route('admin.image.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->image->remove($id);
        $mess = 'Xóa ảnh thành công';
        return redirect()->route('admin.image.getList')->with('success_message', $mess);
    }
}
