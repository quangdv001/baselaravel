<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BillService;
use App\Services\MotelService;
use App\Services\RenterService;
use App\Services\RentService;

class MyBillController extends MyBaseController
{
    private $bill;
    public function __construct(BillService $bill)
    {
        parent::__construct();
        $this->bill = $bill;
    }

    public function index(Request $request){
        $params['motel_id'] = $request->input('motel_id', 0);
        $params['rent_id'] = $request->input('rent_id', 0);
        $params['user_id'] = $this->user->id;
        $data = $this->bill->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->bill->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function showService($id){
        $data = $this->bill->getByIdBillService($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function listBillService(Request $request){
        $params['motel_id'] = $request->input('motel_id', 0);
        $params['rent_id'] = $request->input('rent_id', 0);
        $params['user_id'] = $this->user->id;
        $data = $this->bill->searchBillService($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('motel_name', 'rent_name', 'name', 'note', 'other_price', 'service_price', 'debit_price', 'discount_price', 'total_price', 'status', 'user_id', 'rent_id', 'motel_id');
        $params['user_id'] = $this->user->id;
        $params['status'] = 1;
        $data = $this->bill->create($params);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function createBillService(Request $request){
        $params = $request->only('data');
        // $params['user_id'] = $this->user->id;
        // $params['status'] = 1;
        $data = $this->bill->create($params);
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
        $data = $this->bill->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('motel_name', 'rent_name', 'name', 'note', 'other_price', 'service_price', 'debit_price', 'discount_price', 'total_price', 'status', 'user_id', 'rent_id', 'motel_id');
        $params['user_id'] = $this->user->id;
        $motel = $this->bill->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->bill->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function updateBillService(Request $request, $id){
        $params = $request->only('motel_name', 'rent_name', 'name', 'note', 'other_price', 'service_price', 'debit_price', 'discount_price', 'total_price', 'status', 'user_id', 'rent_id', 'motel_id');
        $params['user_id'] = $this->user->id;
        $motel = $this->bill->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->bill->updateBillService($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->bill->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function removeBillService(Request $request){
        $id = $request->input('id', 0);
        $data = $this->bill->removeBillService($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }
}
