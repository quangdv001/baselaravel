<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContractService;
use App\Services\MotelService;
use App\Services\RenterService;
use App\Services\RentService;

class MyContractController extends MyBaseController
{
    private $contract;
    public function __construct(ContractService $contract)
    {
        parent::__construct();
        $this->contract = $contract;
    }

    public function index(Request $request){
        $params['motel_id'] = $request->input('motel_id', 0);
        $params['user_id'] = $this->user->id;
        $data = $this->contract->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->contract->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function showRenter($id){
        $data = $this->contract->getByIdContractRenter($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function showService($id){
        $data = $this->contract->getByIdContractService($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->contract->create($params);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function createContractRenter(Request $request){
        $params = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->contract->create($params);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function createContractService(Request $request){
        $params = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->contract->create($params);
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
        $data = $this->contract->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id');
        $params['user_id'] = $this->user->id;
        $motel = $this->contract->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->contract->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }
    public function updateContractRenter(Request $request, $id){
        $params = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id');
        $params['user_id'] = $this->user->id;
        $motel = $this->contract->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->contract->updateContractRenter($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }
    public function updateContractService(Request $request, $id){
        $params = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'user_id', 'rent_id');
        $params['user_id'] = $this->user->id;
        $motel = $this->contract->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->contract->updateContractService($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->contract->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
    public function removeContractRenter(Request $request){
        $id = $request->input('id', 0);
        $data = $this->contract->removeContractRenter($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
    public function removeContractService(Request $request){
        $id = $request->input('id', 0);
        $data = $this->contract->removeContractService($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
