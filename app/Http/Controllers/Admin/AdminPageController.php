<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\PageService;
use App\Http\Requests\Admin\PageRequest;
use Astrotomic\Translatable\Locales;
use Illuminate\Support\Facades\App;

class AdminPageController extends AdminBaseController
{
    protected $page;
    protected $category;
    protected $locales;
    public function __construct(PageService $page, Locales $locales)
    {
        parent::__construct();
        $this->page = $page;
        $this->locales = $locales;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('title','type','status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        $page = $this->page->search($dataS);

        return view('admin.page.index')
            ->with('data', $page);
    }

    public function getCreate($locale = 'vi', $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $page = [];
        if($id > 0){
            App::setLocale($locale);
            $page = $this->page->getById($id);
        }
        $listLocales = $this->locales->all();
        return view('admin.page.edit')
            ->with('id', $id)
            ->with('locale', $locale)
            ->with('listLocales', $listLocales)
            ->with('data', $page);
    }

    public function postCreate(PageRequest $request, $locale = 'vi', $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('status');
        $dataTrans = $request->only('title', 'meta', 'content', 'slug');

        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            $res = $this->page->create($data, $dataTrans, $locale);
            if($res){
                $mess = 'Tạo trang thành công';
            }
        } else {
            $page = $this->page->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->page->update($page, $data, $dataTrans, $locale);
            if($res){
                $mess = 'Cập nhật trang thành công';
            }
        }
        return redirect()->route('admin.page.getCreate', ['locale' => $locale, 'id' => $res])->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa trang này!');
        }
        $this->page->remove($id);
        $mess = 'Xóa trang thành công';
        return redirect()->route('admin.page.getList')->with('success_message', $mess);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
