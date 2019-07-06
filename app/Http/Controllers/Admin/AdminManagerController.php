<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ManagerService;
use App\Http\Requests\Admin\ManagerRequest;

class AdminManagerController extends AdminBaseController
{
    protected $manager;
    public function __construct(ManagerService $manager)
    {
        parent::__construct();
        $this->manager = $manager;
    }

    public function index(){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $manager = $this->manager->getAll();

        return view('admin.managerpagefooter.index')
            ->with('data', $manager);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $manager = '';
        if($id > 0){
            $manager = $this->manager->getById($id);
        }

        return view('admin.managerpagefooter.edit')
            ->with('id', $id)
            ->with('data', $manager);
    }

    public function postCreate(ManagerRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'content', 'meta', 'status');
        $mess = '';
        if($id == 0){
            $res = $this->manager->create($data);
            if($res){
                $mess = 'Tạo trang thành công';
            }
        } else {
            $manager = $this->manager->getById($id);
            $res = $this->manager->update($manager, $data);
            if($res){
                $mess = 'Cập nhật trang thành công';
            }
        }
        return redirect()->route('admin.manager.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa liên kết này!');
        }
        $this->footer->remove($id);
        $mess = 'Xóa liên kết thành công';
        return redirect()->route('admin.manager.getList')->with('success_message', $mess);
    }
}
