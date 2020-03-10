<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContractService;

class MyContractController extends Controller
{
    private $contract;
    public function __construct(ContractService $contract)
    {
        $this->contract = $contract;
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
        return view('my.contract.edit')
            ->with('id', $id)
            ->with('data', $data);
    }

    public function postCreate(Request $request, $id = 0){
        $user = auth()->user();
        $data = $request->only('name', 'address', 'phone', 'email', 'id_number');
        $mess = '';
        if($id == 0){
            $data['user_id'] = $user->id;
            $res = $this->contract->create($data);
            if($res){
                $mess = 'Tạo khách hàng thành công';
            }
        } else {
            $article = $this->contract->getById($id);
            $res = $this->contract->update($article, $data);
            if($res){
                $mess = 'Cập nhật khách hàng thành công';
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
