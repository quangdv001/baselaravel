<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AccountRequest;
use App\Services\AdminService;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminAccountController extends AdminBaseController
{
    protected $admin;
    protected $permission;
    public function __construct(AdminService $adminService, PermissionService $permissionService)
    {
        parent::__construct();
        $this->admin = $adminService;
        $this->permission = $permissionService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $params = $request->only('username', 'email', 'phone', 'name', 'active');
        $data = $this->admin->getAll($params);
        return view('admin.account.index')
            ->with('data', $data);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = [];
        if($id > 0){
            $data = $this->admin->getById($id);
        }
        $group = $this->permission->getAll();
        return view('admin.account.edit')
            ->with('id', $id)
            ->with('group', $group)
            ->with('data', $data);
    }

    public function postCreate(AccountRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('username', 'email', 'phone', 'name', 'active');
        $mess = '';
        if($request->filled('password')){
            $data['password'] = bcrypt($request->input('password'));
        }
        if($request->has('permission')){
            $data['permissions'] = implode(',',$request->input('permission'));
        }
        if($id == 0){
            $res = $this->admin->create($data);
            if($res){
                $mess = 'Tạo tài khoản thành công';
            }
        } else {
            $admin = $this->admin->getById($id);
            $res = $this->admin->update($admin, $data);
            if($res){
                $mess = 'Cập nhật tài khoản thành công';
            }
        }
        return redirect()->route('admin.account.getList')->with('success_message', $mess);
    }

}
