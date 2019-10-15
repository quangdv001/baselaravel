<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MotelService;

class MyMotelController extends MyBaseController
{
    private $motel;
    public function __construct(MotelService $motel)
    {
        parent::__construct();
        $this->motel = $motel;
    }

    public function index(Request $request){
        $params['user_id'] = $this->user->id;
        $request = $request->only('limit');
        $params['limit'] = $request['limit'];
        $data = $this->motel->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->motel->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('name', 'address', 'description');
        $params['user_id'] = $this->user->id;
        $data = $this->motel->create($params);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['mess'] = 'Thành công';
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function duplicate(Request $request){
        $id = $request->input('id', 0);
        $data = $this->motel->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('name', 'address', 'description');
        $params['user_id'] = $this->user->id;
        $motel = $this->motel->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->motel->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->motel->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
