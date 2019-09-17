<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\MaterialService;

class AdminMaterialController extends AdminBaseController
{
    protected $material;
    public function __construct(MaterialService $material)
    {
        parent::__construct();
        $this->material = $material;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $material = $this->material->getAll();

        return view('admin.material.index')
            ->with('data', $material);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $material = [];
        if($id > 0){
            $material = $this->material->getById($id);
        }
        return view('admin.material.edit')
            ->with('id', $id)
            ->with('data', $material);
    }

    public function postCreate(Request $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('name');
        $mess = '';
        if($id == 0){
            $res = $this->material->create($data);
            $mess = 'Tạo chất liệu thành công';
        } else {
            $product = $this->product->getById($id);
            $res = $this->product->update($product, $data);
            $mess = 'Cập nhật chất liệu thành công';
        }
        return redirect()->route('admin.material.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->material->remove($id);
        $mess = 'Xóa chất liệu thành công';
        return redirect()->route('admin.material.getList')->with('success_message', $mess);
    }

}
