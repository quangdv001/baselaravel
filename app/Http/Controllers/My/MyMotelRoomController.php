<?php

namespace App\Http\Controllers\My;

use App\Services\ContractService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\My\MotelRoomRequest;
use App\Services\MotelRoomService;
use App\Services\MotelService;

class MyMotelRoomController extends Controller
{
    private $room;
    private $motel;
    private $contractService;

    public function __construct(MotelRoomService $room, MotelService $motel,ContractService $contractService)
    {
        $this->room = $room;
        $this->motel = $motel;
        $this->contractService = $contractService;
    }
    
    public function index(Request $request){
        $user = auth()->user();
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->room->search($params);
        // dd($data);
        return view('my.room.index')->with('data', $data);
    }

    public function getCreate(Request $request, $id = 0){
        $request->flash();
        $user = auth()->user();
        $data = [];
        if($id > 0){
            $data = $this->room->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$data){
                return redirect()->route('my.room.getList');
            }
        }
        $motel = $this->motel->get(['user_id' => $user->id]);
        return view('my.room.edit')
            ->with('id', $id)
            ->with('motel', $motel)
            ->with('data', $data);
    }

    public function postCreate(MotelRoomRequest $request, $id = 0){
        $request->flash();
        $user = auth()->user();
        $data = $request->only('name', 'floor', 'max', 'price', 'description', 'motel_id');
        $mess = '';
        if($id == 0){
            $data['user_id'] = $user->id;
            $res = $this->room->create($data);
            if($res){
                $mess = 'Tạo nhà trọ thành công';
            }
        } else {
            $article = $this->room->getById($id);
            $res = $this->room->update($article, $data);
            if($res){
                $mess = 'Cập nhật nhà trọ thành công';
            }
        }
        return redirect()->route('my.room.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        $user = auth()->user();
        $data = $this->room->first(['id' =>$id, 'user_id' => $user->id]);
        if(!$data){
            return redirect()->route('my.room.getList');
        }
        $this->room->remove($id);
        $mess = 'Xóa thành công';
        return redirect()->route('my.room.getList')->with('success_message', $mess);
    }

    public function editContract($id){
        $currentContract = $this->contractService->first(['motel_room_id'=>$id,'status' =>1 ]);
        if(!empty($currentContract)){
            return redirect()->route('my.contract.getCreate',['id'=>$currentContract->id,'room_id'=>$id]);
        }
        return redirect()->route('my.contract.getCreate',['id'=>0,'room_id'=>$id]);
    }
}
