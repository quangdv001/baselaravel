<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FormulaService;
use App\Services\ServiceService;

class MyServiceController extends MyBaseController
{
    private $service;
    private $formula;
    public function __construct(ServiceService $service, FormulaService $formula)
    {
        parent::__construct();
        $this->service = $service;
        $this->formula = $formula;
    }

    public function index(Request $request){
        // $params['motel_id'] = $request->input('motel_id', 0);
        $params['user_id'] = $this->user->id;
        $data = $this->service->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->service->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('title', 'unit', 'price', 'fixed_price', 'has_formula', 'description');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->service->create($params);
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
        $data = $this->service->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('title', 'unit', 'price', 'fixed_price', 'has_formula', 'description', 'status');
        $params['user_id'] = $this->user->id;
        $motel = $this->service->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->service->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->service->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
