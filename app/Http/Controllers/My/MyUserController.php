<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\My\MotelRequest;
use App\Services\CustomerService;

class MyUserController extends Controller
{
    private $customer;
    public function __construct(CustomerService $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request){
        $user = auth()->user();
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->customer->search($params);
        // dd($data);
        return view('my.customer.index')->with('data', $data);
    }

    public function getCreate($id = 0){
        $user = auth()->user();
        $data = [];
        if($id > 0){
            $data = $this->customer->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$data){
                return redirect()->route('my.customer.getList');
            }
        }
        return view('my.customer.edit')
            ->with('id', $id)
            ->with('data', $data);
    }

    public function postCreate(Request $request, $id = 0){
        $user = auth()->user();
        $data = $request->only('name', 'address', 'phone', 'email', 'id_number');
        $mess = '';
        if($id == 0){
            $data['user_id'] = $user->id;
            $res = $this->customer->create($data);
            if($res){
                $mess = 'Tạo khách hàng thành công';
            }
        } else {
            $article = $this->customer->getById($id);
            $res = $this->customer->update($article, $data);
            if($res){
                $mess = 'Cập nhật khách hàng thành công';
            }
        }
        return redirect()->route('my.customer.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        $user = auth()->user();
        $data = $this->customer->first(['id' =>$id, 'user_id' => $user->id]);
        if(!$data){
            return redirect()->route('my.customer.getList');
        }
        $this->customer->remove($id);
        $mess = 'Xóa thành công';
        return redirect()->route('my.customer.getList')->with('success_message', $mess);
    }
}
