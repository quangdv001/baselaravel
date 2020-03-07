<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ContractService;

class MyContractController extends Controller
{
    private $contract;
    public function __construct(ContractService $contract)
    {
        $this->contract = $contract;
    }
}
