<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MotelService;
use App\Services\RentService;

class MyRentController extends MyBaseController
{
    private $rent;
    public function __construct(RentService $rent)
    {
        parent::__construct();
        $this->rent = $rent;
    }

    public function index(Request $request){
        $params['motel_id'] = $request->input('motel_id', 0);
        $params['user_id'] = $this->user->id;
        $request = $request->only('limit');
        $params['limit'] = $request['limit'];
        $data = $this->rent->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->rent->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('name', 'floor', 'max', 'motel_id', 'price', 'description');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->rent->create($params);
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
        $data = $this->rent->duplicate($id);
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
        $motel = $this->rent->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->rent->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->rent->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
