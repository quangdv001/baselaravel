<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ImageService;
use App\Http\Requests\Admin\ImageRequest;
use App\Services\RegulationService;
use Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\App;

class AdminRegulationController extends AdminBaseController
{
    protected $image;
    public function __construct(RegulationService $image, Locales $locales)
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

        return view('admin.regulation.index')
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
        return view('admin.regulation.edit')
            ->with('id', $id)
            ->with('data', $image);
    }

    public function postCreate(Request $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('name', 'file_id', 'status');
        $mess = '';
        if($id == 0){
            $res = $this->image->create($data);
            if($res){
                $mess = 'Tạo thành công';
            }
        } else {
            $image = $this->image->getById($id);
            $res = $this->image->update($image, $data);
            if($res){
                $mess = 'Cập nhật ảnh thành công';
            }
        }
        return redirect()->route('admin.regulation.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->image->remove($id);
        $mess = 'Xóa ảnh thành công';
        return redirect()->route('admin.regulation.getList')->with('success_message', $mess);
    }
}
