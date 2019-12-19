<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\AdvertiseService;
use App\Http\Requests\Admin\AdvertiseRequest;
class AdminAdvertiseController extends AdminBaseController
{
    protected $advertise;
    public function __construct(AdvertiseService $advertise)
    {
        parent::__construct();
        $this->advertise = $advertise;
    }
    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $advertise = $this->advertise->getAll();
        return view('admin.advertise.index')
            ->with('data', $advertise);
    }
    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $advertise = [];
        if($id > 0){
            $advertise = $this->advertise->getById($id);
        }
        return view('admin.advertise.edit')
            ->with('id', $id)
            ->with('data', $advertise);
    }
    public function postCreate(AdvertiseRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->except(['time', '_token']);
        $time = $request->input('time','');
        if($time != ''){
            $arrTime = explode(' - ', $time);
            $data['start_time'] = strtotime(str_replace('/', '-', $arrTime[0]));
            $data['end_time'] = strtotime(str_replace('/', '-', $arrTime[1]));
        }
        if($id == 0){
            $res = $this->advertise->create($data);
            if($res){
                $mess = 'Tạo quảng cáo thành công';
            }
        } else {
            $advertise = $this->advertise->getById($id);
            $res = $this->advertise->update($advertise, $data);
            if($res){
                $mess = 'Cập nhật quảng cáo thành công';
            }
        }
        return redirect()->route('admin.advertise.getList')->with('success_message', $mess);
    }
    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa quảng cáo này!');
        }
        $this->advertise->remove($id);
        $mess = 'Xóa quảng cáo thành công';
        return redirect()->route('admin.advertise.getList')->with('success_message', $mess);
    }
}