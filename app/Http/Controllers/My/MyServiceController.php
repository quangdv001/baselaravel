<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\My\ServiceRequest;
use App\Services\ServiceFormulaService;
use App\Services\ServiceService;

class MyServiceController extends Controller
{
    private $formula;
    public function __construct(ServiceService $service, ServiceFormulaService $formula)
    {
        $this->service = $service;
        $this->formula = $formula;
    }

    public function index(Request $request){
        $user = auth()->user();
        $params['user_id'] = $user->id;
        $params['limit'] = 0;
        $params['sortBy'] = 'id';
        $data = $this->service->search($params);
        // dd($data);
        return view('my.service.index')->with('data', $data);
    }

    public function getCreate(Request $request, $id = 0){
        $user = auth()->user();
        $data = [];
        if($id > 0){
            $data = $this->service->first(['id' =>$id, 'user_id' => $user->id]);
            if(!$data){
                return redirect()->route('my.service.getList');
            }
        }
        return view('my.service.edit')
            ->with('id', $id)
            ->with('data', $data);
    }

    public function postCreate(ServiceRequest $request, $id = 0){
        $request->flash();
        $user = auth()->user();
        $data = $request->only('title', 'unit', 'fixed_price', 'price', 'description');
        $mess = '';
        if($id == 0){
            $data['user_id'] = $user->id;
            $res = $this->service->create($data);
            if($res){
                $mess = 'Tạo dịch vụ thành công';
            }
        } else {
            $article = $this->service->getById($id);
            $res = $this->service->update($article, $data);
            if($res){
                $mess = 'Cập nhật dịch vụ thành công';
            }
        }
        return redirect()->route('my.service.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        $user = auth()->user();
        $data = $this->service->first(['id' =>$id, 'user_id' => $user->id]);
        if(!$data){
            return redirect()->route('my.service.getList');
        }
        $this->service->remove($id);
        $mess = 'Xóa thành công';
        return redirect()->route('my.service.getList')->with('success_message', $mess);
    }

    public function getFormula($id){
        $user = auth()->user();
        $service = $this->service->first(['id' => $id, 'user_id' => $user->id]);
        $data = $this->formula->get(['service_id' => $id, 'user_id' => $user->id]);
        return view('my.formula.edit')
            ->with('id', $id)
            ->with('data', $data);
    }

    public function postFormula(Request $request, $id){
        $data = $request->input('data', []);
        $user = auth()->user();
        if(sizeof($data) > 0){
            foreach($data as $k => $v){
                $data[$k]['user_id'] = $user->id;
                $data[$k]['service_id'] = $id;
            }
        }
        $res = $this->formula->insert($data, $id);
        if($res){
            return redirect()->route('my.service.getList')->with('success_message', 'Cập nhật thành công');
        }
        return redirect()->back()->with('error_message', 'Có lỗi xảy ra');
    }
}
