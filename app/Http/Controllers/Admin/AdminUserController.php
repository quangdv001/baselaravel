<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\OrderService;
use App\Services\UserService;

class AdminUserController extends AdminBaseController
{
    private $customer;
    private $userStatus = [
        0 => 'Chưa kích hoạt',
        1 => 'Hoạt động',
    ];
    private $userBadge = [
        0 => 'badge badge-danger',
        1 => 'badge badge-success',
    ];
    public function __construct(UserService $customer)
    {
        parent::__construct();
        $this->customer = $customer;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('name','phone','email','status');
        $dataS['limit'] = 10;
        $dataS['sortBy'] = 'id';
        $user = $this->customer->search($dataS);
        // dd($order);
        return view('admin.user.index')
            ->with('userStatus', $this->userStatus)
            ->with('userBadge', $this->userBadge)
            ->with('data', $user);
    }

    public function updateStatus($id, Request $request){
        $customer = $this->customer->getById($id);
        if($customer){
            $data['status'] = $customer->status == 1 ? 0 : 1;
            $res = $this->customer->update($customer, $data);
            if($res){
                return redirect()->back()->with('success_message', 'Cập nhật trạng thái thành công.');
            }
        }
        return redirect()->back()->with('error_message', 'Cập nhật trạng thái thất bại.');
    }

}
