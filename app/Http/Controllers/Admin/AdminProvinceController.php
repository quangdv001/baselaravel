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
        $count = $this->province->countProvince();
        if($count == 0){
            $this->getImport();
        }
    }

    public function index(){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $province = $this->province->getProvince();
        return view('admin.province.listProvince')
            ->with('data', $province);
    }

    public function listDistrict(){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $district = $this->province->getDistrict();
        return view('admin.province.listDistrict')
            ->with('data', $district);
    }

    public function listWard(){
        if (Gate::denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $ward = $this->province->getWard();
        return view('admin.province.listWard')
            ->with('data', $ward);
    }

    public function getImport(){
        Excel::import(new ProvinceImport($this->province), storage_path('app/import/Province-District-Ward.xls'));
    }

}
