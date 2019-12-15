<?php

namespace App\Http\Controllers\Admin;

use App\Services\GeneralInfoService;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GeneralInfo\UpdateRequest;
use Illuminate\Support\Facades\Gate;

class AdminGeneralInfoController extends AdminBaseController
{
    private $arrType = [
        GeneralInfoService::TYPE_TEXT => 'Text',
        GeneralInfoService::TYPE_SOCIAL => 'Social',
        GeneralInfoService::TYPE_IMAGE => 'Image',
    ];

    protected $generalInfoService;

    public function __construct(GeneralInfoService $generalInfoService)
    {
        parent::__construct();
        $this->generalInfoService = $generalInfoService;
    }

    public function index(){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $this->generalInfoService->get(['limit'=>100]);
        return view('admin.general_info.index')
            ->with('data', $data);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $article = [];
        if($id > 0){
            $article = $this->generalInfoService->getById($id);
        }

        return view('admin.general_info.edit')
            ->with('id', $id)
            ->with('data', $article)
            ->with('arrType', $this->arrType);
    }

    public function postCreate(UpdateRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('name', 'status', 'type', 'content', 'img', 'link', 'icon');
        $mess = '';
        if($id == 0){
            $res = $this->generalInfoService->create($data);
            if($res){
                $mess = 'Tạo thông tin thành công';
            }
        } else {
            $article = $this->generalInfoService->getById($id);
            $res = $this->generalInfoService->update($article, $data);
            if($res){
                $mess = 'Cập nhật thông tin thành công';
            }
        }
        return redirect()->route('admin.generalInfo.index')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa thông tin này!');
        }
        $this->generalInfoService->remove($id);
        $mess = 'Xóa thông tin thành công';
        return redirect()->route('admin.generalInfo.index')->with('success_message', $mess);
    }
}
