<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\My\MotelRequest;
use App\Services\MotelService;

class MyMotelController extends Controller
{
    private $motel;
    public function __construct(MotelService $motel)
    {
        $this->motel = $motel;
    }

    public function index(Request $request){
        $user = auth()->user();
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->motel->search($params);
        // dd($data);
        return view('my.motel.index')->with('data', $data);
    }

    public function getCreate($id = 0){
        $user = auth()->user();
        $data = [];
        if($id > 0){
            $data = $this->motel->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$data){
                return redirect()->route('my.motel.getList');
            }
        }
        return view('my.motel.edit')
            ->with('id', $id)
            ->with('data', $data);
    }

    public function postCreate(MotelRequest $request, $id = 0){
        $user = auth()->user();
        $data = $request->only('name', 'address', 'description');
        $mess = '';
        if($id == 0){
            $data['user_id'] = $user->id;
            $res = $this->motel->create($data);
            if($res){
                $mess = 'Tạo nhà trọ thành công';
            }
        } else {
            $article = $this->motel->getById($id);
            $res = $this->motel->update($article, $data);
            if($res){
                $mess = 'Cập nhật nhà trọ thành công';
            }
        }
        return redirect()->route('my.motel.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        $user = auth()->user();
        $data = $this->motel->first(['id' =>$id, 'user_id' => $user->id]);
        if(!$data){
            return redirect()->route('my.motel.getList');
        }
        $this->motel->remove($id);
        $mess = 'Xóa thành công';
        return redirect()->route('my.motel.getList')->with('success_message', $mess);
    }
}
