<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('my.motel.index')->with('data', $data);
    }
}
