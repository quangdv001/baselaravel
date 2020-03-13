<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BillService;
use App\Services\ContractService;
use App\Services\CustomerService;
use App\Services\ServiceService;

class MyBillController extends Controller
{
    private $contract;
    private $customer;
    private $bill;
    private $service;
    public function __construct(ContractService $contract, CustomerService $customer, BillService $bill, ServiceService $service)
    {
        $this->contract = $contract;
        $this->customer = $customer;
        $this->bill = $bill;
        $this->service = $service;
    }

    public function getCreate($contractId, $id = 0){
        $user = auth()->user();
        $contract = $this->contract->first(['id' =>$contractId, 'user_id' => $user->id]);
        $bill = [];
        if($id > 0){
            $bill = $this->bill->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$bill){
                return redirect()->route('my.contract.getList');
            }
        }
        $customer = $this->customer->get(['user_id' => $user->id]);
        $service = $this->service->get(['user_id' => $user->id]);
        return view('my.contract.edit')
            ->with('id', $id)
            ->with('bill', $bill);
    }

    public function postCreate(Request $request, $contractId, $id = 0){
        $user = auth()->user();
        // $data = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'customer_id', 'motel_room_id');
        $service = $request->input('service', []);
        $contract = $this->contract->first(['id' =>$contractId, 'user_id' => $user->id]);
        $services = $this->service->get(['user_id' => $user->id])->load('formula')->keyBy('id');
        if(sizeof($service) > 0){
            foreach($service as $k => $v){
                if(isset($services[$k])){
                    
                }
            }
        }
        $mess = '';
        if($id == 0){
            $data['user_id'] = $user->id;
            $res = $this->contract->create($data, $service);
            if($res){
                $mess = 'Tạo hợp đồng thành công';
            }
        } else {
            $article = $this->contract->getById($id);
            $res = $this->contract->update($article, $data, $service);
            if($res){
                $mess = 'Cập nhật hợp đồng thành công';
            }
        }
        return redirect()->route('my.contract.getList')->with('success_message', $mess);
    }
}
