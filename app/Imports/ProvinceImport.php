<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Services\ProvinceService;
use Illuminate\Support\Facades\Log;

class ProvinceImport implements ToCollection
{
    private $province;
    public function __construct(ProvinceService $province)
    {
        $this->province = $province;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $province = $district = $ward = [];
        $count = $this->province->countProvince();
        if($count == 0){
            foreach($collection as $v){
                $province[$v[1]]['province_id'] = $v[1];
                $province[$v[1]]['name'] = $v[0];
                $district[$v[5]]['district_id'] = $v[5];
                $district[$v[5]]['name'] = $v[3];
                $district[$v[5]]['province_id'] = $v[1];
                $ward[$v[8]]['ward_id'] = $v[8];
                $ward[$v[8]]['name'] = $v[6];
                $ward[$v[8]]['district_id'] = $v[5];
            }
            Log::info($district);
            $countDistrict = $this->province->countDistrict();
            $countWard = $this->province->countWard();
            $this->province->createProvince(array_values($province));
            if($countDistrict == 0){
                $this->province->createDistrict(array_values($district));
            }
            if($countWard == 0){
                $this->province->createWard(array_values($ward));
            }
        }
        
    }
}
