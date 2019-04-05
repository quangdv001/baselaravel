<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ProvinceService;
use App\Imports\ProvinceImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminProvinceController extends AdminBaseController
{
    protected $province;
    public function __construct(ProvinceService $province)
    {
        parent::__construct();
        $this->province = $province;
    }

    public function index(Request $request){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $this->getImport();
        return 1;
        // return view('admin.category.index')
        //     ->with('html', $html);
    }

    public function getImport(){
        Excel::import(new ProvinceImport($this->province), storage_path('app/import/Province-District-Ward.xls'));
    }

}
