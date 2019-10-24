<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MotelService;
use App\Services\RenterService;
use App\Services\RentService;

class MyRenterController extends MyBaseController
{
    private $renter;
    public function __construct(RenterService $renter)
    {
        parent::__construct();
        $this->renter = $renter;
    }

    public function index(Request $request){
        $params['motel_id'] = $request->input('motel_id', 0);
        $params['user_id'] = $this->user->id;
        $data = $this->renter->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->renter->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('name', 'id_number', 'id_time', 'id_place', 'status', 'phone', 'email', 'gender', 'address');
        $params['user_id'] = $this->user->id;
        $data = $this->renter->create($params);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function duplicate(Request $request){
        $id = $request->input('id', 0);
        $data = $this->renter->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('name', 'floor', 'max', 'motel_id', 'price', 'description', 'status');
        $params['user_id'] = $this->user->id;
        $motel = $this->renter->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->renter->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->renter->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
