<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BillService;
use App\Services\ContractService;
use App\Services\CustomerService;

class MyBillController extends Controller
{
    private $contract;
    private $customer;
    private $bill;
    public function __construct(ContractService $contract, CustomerService $customer, BillService $bill)
    {
        $this->contract = $contract;
        $this->customer = $customer;
        $this->bill = $bill;
    }

    public function getCreate($id = 0){
        $user = auth()->user();
        $data = [];
        if($id > 0){
            $data = $this->contract->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$data){
                return redirect()->route('my.contract.getList');
            }
        }
        $customer = $this->customer->get(['user_id' => $user->id]);
        return view('my.contract.edit')
            ->with('id', $id)
            ->with('data', $data);
    }
}
