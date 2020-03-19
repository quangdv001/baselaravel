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

    public function index(Request $request){
        $user = auth()->user();
        $params['contract_id'] = $request->input('contract_id', 0);
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->bill->search($params);
        return view('my.bill.index')->with('data', $data);
    }

    public function getCreate($contractId){
        $user = auth()->user();
        $contract = $this->contract->first(['id' =>$contractId, 'user_id' => $user->id])->load('service');
        $customer = $this->customer->get(['user_id' => $user->id]);
        $service = $this->service->get(['user_id' => $user->id]);
        return view('my.bill.edit')
            ->with('contract', $contract)
            ->with('customer', $customer)
            ->with('service', $service);
    }

    public function postCreate(Request $request, $contractId){
        $user = auth()->user();
        $data = $request->only('name', 'note', 'room_price', 'other_price', 'debit_price', 'discount_price');
        $service = $request->input('service', []);
        $contract = $this->contract->first(['id' =>$contractId, 'user_id' => $user->id]);
        $services = $this->service->get(['user_id' => $user->id])->load('formula')->keyBy('id');
        $arrService = [];
        $servicePrice = 0;
        if(sizeof($service) > 0){
            foreach($service as $k => $v){
                if(isset($services[$k])){
                    $arrService[$k]['unit'] = $services[$k]->unit;
                    $arrService[$k]['status'] = 1;
                    $arrService[$k]['service_id'] = $k;
                    $arrService[$k]['user_id'] = 1;
                                
                    if($services[$k]->formula){
                        foreach($services[$k]->formula as $val){
                            if($v >= $val->start && $v <= $val->end){
                                $arrService[$k]['price'] = $val->price;
                                $arrService[$k]['total'] = $val->price*$v['qty'];
                                $servicePrice += $arrService[$k]['total'];
                            }
                        }
                    } else {
                        $arrService[$k]['price'] = $v['price'];
                        $arrService[$k]['total'] = $v['price']*$v['qty'];
                        $servicePrice += $arrService[$k]['total'];
                    }
                }
            }
        }
        $data['service_price'] = $servicePrice;
        $data['total_price'] = $data['room_price'] + $data['other_price'] + $data['debit_price'] + $data['service_price'] - $data['discount_price'];
        $mess = '';
        $data['user_id'] = $user->id;
        $res = $this->bill->create($data, $arrService);
        if($res){
            $mess = 'Tạo hợp đồng thành công';
        }
        return redirect()->route('my.bill.detail', $res->id)->with('success_message', $mess);
    }

    public function detail($id){
        $user = auth()->user();
        $bill = $this->bill->getById($id)->load('service');
        return view('my.bill.detail')->with('bill', $bill)
    }
}
