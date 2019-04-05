<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Services\ProvinceService;

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
        //
    }
}
