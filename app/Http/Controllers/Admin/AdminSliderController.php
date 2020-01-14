<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\App;
use App\Services\SliderService;
use App\Http\Requests\Admin\SliderRequest;

class AdminSliderController extends AdminBaseController
{
    protected $slider;
    public function __construct(SliderService $slider)
    {
        parent::__construct();
        $this->slider = $slider;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }

        return view('admin.slider.index')
            ->with('data',$this->slider->getAll());
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $slider = [];
        if($id > 0){
            $slider = $this->slider->getById($id);
        }

        return view('admin.slider.edit')
            ->with('id', $id)
            ->with('data', $slider);
    }

    public function postCreate(SliderRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'description', 'img', 'position', 'status', 'img_inside');
        
        $mess = '';
        if($id == 0){
            $res = $this->slider->create($data);
            if($res)
                $mess = 'Tạo slide thành công';

        } else {
            $slider = $this->slider->getById($id);
            $res = $this->slider->update($slider, $data);
            if($res)
                $mess = 'Cập nhật slide thành công';

        }
        return redirect()->route('admin.slider.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->slider->remove($id);
        $mess = 'Xóa slide thành công';
        return redirect()->route('admin.slider.getList')->with('success_message', $mess);
    }
}
