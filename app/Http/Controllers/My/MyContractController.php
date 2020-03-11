<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContractService;
use App\Services\CustomerService;

class MyContractController extends Controller
{
    private $contract;
    private $customer;
    public function __construct(ContractService $contract, CustomerService $customer)
    {
        $this->contract = $contract;
        $this->customer = $customer;
    }

    public function index(Request $request){
        $user = auth()->user();
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->contract->search($params);
        // dd($data);
        return view('my.contract.index')->with('data', $data);
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

    public function postCreate(Request $request, $id = 0){
        $user = auth()->user();
        $data = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'customer_id', 'motel_room_id');
        $service = $request->input('service', []);
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

    public function remove($id = 0){
        $user = auth()->user();
        $data = $this->contract->first(['id' =>$id, 'user_id' => $user->id]);
        if(!$data){
            return redirect()->route('my.contract.getList');
        }
        $this->contract->remove($id);
        $mess = 'Xóa thành công';
        return redirect()->route('my.contract.getList')->with('success_message', $mess);
    }
}
