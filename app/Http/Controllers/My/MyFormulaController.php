<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\FormulaService;
use App\Services\ServiceService;

class MyFormulaController extends MyBaseController
{
    private $service;
    private $formula;
    public function __construct(FormulaService $formula)
    {
        parent::__construct();
        $this->formula = $formula;
    }

    public function index(Request $request){
        // $params['motel_id'] = $request->input('motel_id', 0);
        $params['user_id'] = $this->user->id;
        $data = $this->formula->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->formula->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('service_id', 'user_id', 'name', 'description');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->formula->create($params);
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
        $data = $this->formula->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('service_id', 'user_id', 'name', 'description');
        $params['user_id'] = $this->user->id;
        $motel = $this->formula->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->formula->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->formula->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
