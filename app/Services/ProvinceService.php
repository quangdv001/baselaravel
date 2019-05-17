<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;


use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;

class ProvinceService
{
    private $province;
    private $district;
    private $ward;
    public function __construct(Province $province, District $district, Ward $ward)
    {
        $this->province = $province;
        $this->district = $district;
        $this->ward = $ward;
    }


    public function createProvince($data)
    {
        try {
            DB::beginTransaction();
            $province = $this->province->insert($data);
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createDistrict($data)
    {
        try {
            DB::beginTransaction();
            $district = $this->district->insert($data);
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createWard($data)
    {
        try {
            DB::beginTransaction();
            $ward = $this->ward->insert($data);
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function countProvince(){
        return $this->province->all()->count();
    }

    public function countDistrict(){
        return $this->district->all()->count();
    }

    public function countWard(){
        return $this->ward->all()->count();
    }

    public function getProvince(){
        return $this->province->all();
    }

    public function getDistrict(){
        return $this->district->all();
    }

    public function getWard(){
        return $this->ward->all();
    }

    public function getProvincePluck(){
        return $this->province->pluck('name', 'province_id');
    }

    public function getDistrictByProvince($id){
        return $this->district->where('province_id', $id)->pluck('name', 'district_id');
    }

    public function getWardByDistrict($id){
        return $this->ward->where('district_id', $id)->pluck('name', 'ward_id');
    }

    public function getDistrictPluck(){
        return $this->district->pluck('name', 'district_id');
    }

    public function getWardPluck(){
        return $this->ward->pluck('name', 'ward_id');
    }

}