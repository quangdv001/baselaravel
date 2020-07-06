<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ArticleService;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\CategoryService;
use App\Services\RoomService;
use App\Http\Requests\Admin\RoomRequest;
use App\Models\Transaction;
use App\Services\CustomerService;
use App\Services\TransactionService;
use App\Services\UserService;

class AdminTransactionController extends AdminBaseController
{
    private $transaction;
    private $customer;
    public function __construct(TransactionService $transaction, UserService $customer)
    {
        parent::__construct();
        $this->transaction = $transaction;
        $this->customer = $customer;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('name','email','from','to');
        $dataS['limit'] = 10;
        $data = $this->transaction->search($dataS);
        $customer = $this->customer->getAll();

        return view('admin.transaction.index')
            ->with('customer', $customer)
            ->with('data', $data);
    }

    public function postCreate(Request $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('user_id', 'amount', 'duration');
        $data['created_time'] = time();
        $res['success'] = 0;
        if(!isset($data['user_id']) || $data['user_id'] <= 0){
            $res['mess'] = 'Mời chọn người dùng';
            return response()->json($res);
        }
        if(!isset($data['amount']) || $data['amount'] <= 0){
            $res['mess'] = 'Mời nhập số tiền';
            return response()->json($res);
        }
        if(!isset($data['duration']) || $data['duration'] <= 0){
            $res['mess'] = 'Mời nhập thời gian';
            return response()->json($res);
        }
        $data['duration'] = $data['duration']*86400;
        $transaction = $this->transaction->create($data);
        
        if($transaction){
            $user = $this->customer->getById($data['user_id']);
            $user->expired_at = time() + $data['duration'];
            $user->save();
            $res['success'] = 1;
        }
        
        return response()->json($res);
    }




}
