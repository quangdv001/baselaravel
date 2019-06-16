<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Http\Requests\Admin\ProductRequest;
use App\Services\OrderService;

class AdminOrderController extends AdminBaseController
{
    private $order;
    private $orderStatus = [
        1 => 'Mới tạo',
        2 => 'Xác nhận',
        3 => 'Đang giao hàng',
        4 => 'Hoàn Thành',
        5 => 'Hủy'
    ];
    private $orderBadge = [
        1 => 'badge badge-primary',
        2 => 'badge badge-info',
        3 => 'badge badge-warning',
        4 => 'badge badge-success',
        5 => 'badge badge-danger'
    ];
    public function __construct(OrderService $order)
    {
        parent::__construct();
        $this->order = $order;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('name','phone','status', 'ids');
        $dataS['limit'] = 10;
        $dataS['sortBy'] = 'id';
        $order = $this->order->search($dataS);
        // dd($order);
        return view('admin.order.index')
            ->with('orderStatus', $this->orderStatus)
            ->with('orderBadge', $this->orderBadge)
            ->with('data', $order);
    }

    public function show($id){
        $order = $this->order->getById($id);
        $orderInfo = $order->orderInfo;
        $orderDetail = $order->orderDetail;
        // dd($order);

        return view('admin.order.show')
            ->with('orderStatus', $this->orderStatus)
            ->with('orderBadge', $this->orderBadge)
            ->with('data', $order);
    }

    public function updateStatus($id, Request $request){
        $data = $request->only('status');
        $order = $this->order->getById($id);
        if($order){
            $res = $this->order->update($order, $data);
            if($res){
                return redirect()->route('admin.order.show', $id)->with('success_message', 'Cập nhật trạng thái thành công.');
            }
        }
        return redirect()->route('admin.order.show', $id)->with('error_message', 'Cập nhật trạng thái thất bại.');
    }

}
