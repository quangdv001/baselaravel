<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\FooterService;
use App\Http\Requests\Admin\FooterRequest;

class AdminFooterController extends AdminBaseController
{
    protected $footer;
    public function __construct(FooterService $footer)
    {
        parent::__construct();
        $this->footer = $footer;
    }

    public function index(){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $footer = $this->footer->getAll();

        return view('admin.footer.index')
            ->with('data', $footer);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $footer = '';
        if($id > 0){
            $footer = $this->footer->getById($id);
        }

        return view('admin.footer.edit')
            ->with('id', $id)
            ->with('data', $footer);
    }

    public function postCreate(Request $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('code', 'value');
        $mess = '';
        if($id == 0){
            $res = $this->footer->create($data);
            if($res){
                $mess = 'Tạo liên kết thành công';
            }
        } else {
            $footer = $this->footer->getById($id);
            $res = $this->footer->update($footer, $data);
            if($res){
                $mess = 'Cập nhật liên kết thành công';
            }
        }
        return redirect()->route('admin.footerSocial.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa liên kết này!');
        }
        $this->footer->remove($id);
        $mess = 'Xóa liên kết thành công';
        return redirect()->route('admin.footerSocial.getList')->with('success_message', $mess);
    }
}
