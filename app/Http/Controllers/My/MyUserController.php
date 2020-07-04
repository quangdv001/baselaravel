<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\My\MotelRequest;
use App\Services\CustomerService;
use App\Services\UserService;

class MyUserController extends Controller
{
    private $user;
    public function __construct(UserService $user)
    {
        $this->user = $user;
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

    public function getCreate(Request $request){
        $user = auth()->user();
        $data = [];
        return view('my.user.edit')
            ->with('data', $user);
    }

    public function postCreate(Request $request){
        $user = auth()->user();
        $data = $request->only('name', 'phone', 'email', 'id_number', 'address', 'id_place', 'id_time');
        $data['id_time'] = strtotime($data['id_time']);
        $mess = '';
        
        $article = $this->user->getById($user->id);
        $res = $this->user->update($article, $data);
        if($res){
            $mess = 'Cập nhật user thành công';
        }
        
        return redirect()->route('my.user.getCreate')->with('success_message', $mess);
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
