<?php

namespace App\Http\Controllers\Admin;

use App\Services\GeneralInfoService;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\GeneralInfo\UpdateRequest;
use Illuminate\Support\Facades\Gate;

class AdminGeneralInfoController extends AdminBaseController
{
    private $arrTypeDelete = [
        GeneralInfoService::TYPE_PHONE_EXTRA => 'Số điện thoại',
        GeneralInfoService::TYPE_EMAIL_EXTRA => 'Email',
        GeneralInfoService::TYPE_SOCIAL => 'Social',
    ];

    private $arrTypeOnly = [
        GeneralInfoService::TYPE_LOGO => 'Logo',
        GeneralInfoService::TYPE_NAME => 'Tên công ty',
        GeneralInfoService::TYPE_ADDRESS => 'Địa chỉ',
        GeneralInfoService::TYPE_CERTIFICATE_TEXT => 'Tên chứng chỉ',
        GeneralInfoService::TYPE_CERTIFICATE_IMAGE => 'Ảnh chứng chỉ',
        GeneralInfoService::TYPE_CERTIFICATE_NUMBER => 'Số chứng chỉ',
        GeneralInfoService::TYPE_PHONE_MAIN => 'Số điện thoại',
        GeneralInfoService::TYPE_EMAIL_MAIN => 'Email',
    ];
    private $arrType =[
        GeneralInfoService::TYPE_LOGO => 'Logo',
        GeneralInfoService::TYPE_NAME => 'Tên công ty',
        GeneralInfoService::TYPE_ADDRESS => 'Địa chỉ',
        GeneralInfoService::TYPE_CERTIFICATE_TEXT => 'Tên chứng chỉ',
        GeneralInfoService::TYPE_CERTIFICATE_IMAGE => 'Ảnh chứng chỉ',
        GeneralInfoService::TYPE_CERTIFICATE_NUMBER => 'Số chứng chỉ',
        GeneralInfoService::TYPE_PHONE_MAIN => 'Số điện thoại',
        GeneralInfoService::TYPE_EMAIL_MAIN => 'Email',
        GeneralInfoService::TYPE_PHONE_EXTRA => 'Số điện thoại',
        GeneralInfoService::TYPE_EMAIL_EXTRA => 'Email',
        GeneralInfoService::TYPE_SOCIAL => 'Social',
    ];

    protected $generalInfoService;

    public function __construct(GeneralInfoService $generalInfoService)
    {
        parent::__construct();
        $this->generalInfoService = $generalInfoService;
    }

    public function index()
    {
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message', 'Bạn không có quyền vào trang này!');
        }
        $data = $this->generalInfoService->get(['limit' => 100]);
        return view('admin.general_info.index')
            ->with('arrTypeDelete',$this->arrTypeDelete)
            ->with('arrTypeOnly', $this->arrTypeOnly)
            ->with('arrType', $this->arrType)
            ->with('data', $data);
    }

    public function getCreate($id = 0)
    {
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message', 'Bạn không có quyền vào trang này!');
        }
        $article = [];
        if ($id > 0) {
            $article = $this->generalInfoService->getById($id);
        }

        return view('admin.general_info.edit')
            ->with('id', $id)
            ->with('data', $article)
            ->with('arrTypeDelete',$this->arrTypeDelete)
            ->with('arrTypeOnly', $this->arrTypeOnly)
            ->with('arrType', $this->arrType);
    }

    public function postCreate(Request $request, $id = 0)
    {
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message', 'Bạn không có quyền vào trang này!');
        }
        $data = $request->only('name', 'status', 'type', 'content', 'img', 'link', 'icon');
        $mess = '';
        if ($id == 0) {
            if (in_array($data['type'], $this->arrTypeOnly)) {
                $check = $this->generalInfoService->first(['conditions' => [['type' => $data['type']]]]);
                if (!empty($check)) {
                    $mess = $this->arrTypeOnly[$data['type']] . ' đã tồn tại,bạn không thể thêm mới!';
                    return redirect()->route('admin.generalInfo.index')->with('error_message', $mess);
                }
            }
            $res = $this->generalInfoService->create($data);
            if ($res) {
                $mess = 'Tạo thông tin thành công';
            }
        } else {
            $article = $this->generalInfoService->getById($id);
            $res = $this->generalInfoService->update($article, $data);
            if ($res) {
                $mess = 'Cập nhật thông tin thành công';
            }
        }
        return redirect()->route('admin.generalInfo.index')->with('success_message', $mess);
    }

    public function remove($id = 0)
    {
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message', 'Bạn không có quyền xóa thông tin này!');
        }
        $info = $this->generalInfoService->getById($id);
        if(!empty($info)){
            if (in_array($info->type, $this->arrTypeOnly)) {
                $mess = $this->arrTypeOnly[$info->type] . ' đã tồn tại,bạn không thể thêm mới!';
                return redirect()->route('admin.generalInfo.index')->with('success_message', $mess);
            }
            $this->generalInfoService->remove($id);
            $mess = 'Xóa thông tin thành công';
            return redirect()->route('admin.generalInfo.index')->with('success_message', $mess);
        }
        $mess = 'Không tìm thấy thông tin muốn xóa';
        return redirect()->route('admin.generalInfo.index')->with('error_message', $mess);
    }
}
