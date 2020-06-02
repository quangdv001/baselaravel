<?php

namespace App\Http\Controllers\My;

use App\Services\MotelRoomService;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContractService;
use App\Services\CustomerService;

class MyContractController extends Controller
{
    private $contract;
    private $customer;
    private $motelRoom;
    private $serviceService;
    public function __construct(ContractService $contract, CustomerService $customer,MotelRoomService $motelRoom,ServiceService $serviceService)
    {
        $this->contract = $contract;
        $this->customer = $customer;
        $this->motelRoom = $motelRoom;
        $this->serviceService = $serviceService;
    }

    public function index(Request $request){
        $user = auth()->user();
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->contract->search($params);
        return view('my.contract.index')->with('data', $data);
    }

    public function getCreate($id = 0){
        $user = auth()->user();
        $data = [];
        $listRoom = $this->motelRoom->get([]);
        $listService = $this->serviceService->get([]);
        $listCustomer = $this->customer->get([]);
        if($id > 0){
            $data = $this->contract->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$data){
                return redirect()->route('my.contract.getList');
            }
        }
        return view('my.contract.edit')
            ->with('id', $id)
            ->with('listRoom', $listRoom)
            ->with('listService', $listService)
            ->with('listCustomer', $listCustomer)
            ->with('data', $data);
    }

    public function postCreate(Request $request, $id = 0){
        $user = auth()->user();
        $data = $request->only('name', 'note', 'deposits', 'duration', 'payment_period', 'start', 'end', 'status', 'customer_id', 'motel_room_id');
        $service = $request->input('service', []);
        $data['payment_period'] = strtotime(str_replace('/','-',$data['payment_period']));
        $data['start'] = strtotime(str_replace('/','-',$data['start']));
        $data['end'] = strtotime(str_replace('/','-',$data['end']));
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
