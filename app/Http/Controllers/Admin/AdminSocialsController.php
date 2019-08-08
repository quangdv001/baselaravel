<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\App;
use App\Services\SocialsService;

class AdminSocialsController extends AdminBaseController
{
    protected $socials;
    public function __construct(SocialsService $socials)
    {
        parent::__construct();
        $this->socials = $socials;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }

        return view('admin.socials.index')
            ->with('data',$this->socials->getAll());
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        
        if($id > 0){
            $socials = $this->socials->getById($id);
        }

        return view('admin.socials.edit')
            ->with('id', $id)
            ->with('data', $socials);
    }

    public function postCreate(Request $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'value');
        
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            $res = $this->socials->create($data);
            if($res)
                $mess = 'Tạo bài viết thành công';

        } else {
            $socials = $this->socials->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->socials->update($socials, $data);
            if($res)
                $mess = 'Cập nhật bài viết thành công';

        }
        return redirect()->route('admin.socials.getList')->with('success_message', $mess);
    }
}
