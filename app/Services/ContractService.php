<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractRenter;
use App\Models\ContractService as AppContractService;
use Exception;
use Illuminate\Support\Facades\DB;

class ContractService
{
    public function __construct(Contract $contract, ContractRenter $contractRenter, AppContractService $contractService)
    {
        $this->contract = $contract;
        $this->contractRenter = $contractRenter;
        $this->contractService = $contractService;
    }

    public function search($data){
        $query = $this->contract;
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (isset($data['user_id']) && $data['user_id'] != '') {
            $query = $query->where('user_id', $data['user_id']);
        }
        if (isset($data['motel_id']) && $data['motel_id'] != '') {
            $query = $query->where('motel_id', $data['motel_id']);
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->with(['rent' ,'renter', 'service'])->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->contract;
            foreach ($data as $key => $value) {
                $admin->$key = $value;
            }
            $admin->save();
            DB::commit();
            return $admin;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createContractRenter($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->contractRenter;
            foreach ($data as $key => $value) {
                $admin->$key = $value;
            }
            $admin->save();
            DB::commit();
            return $admin;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createContractService($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->contractService;
            foreach ($data as $key => $value) {
                $admin->$key = $value;
            }
            $admin->save();
            DB::commit();
            return $admin;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($admin, $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $admin->$key = $value;
            }
            $admin->save();
            DB::commit();
            return $admin;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function remove($id){
        $law = $this->contract->find($id);
        $law->delete();
    }
    public function removeContractRenter($data){
        $law = $this->contractRenter->where('contract_id', $data['contract_id'])->where('renter_id', $data['renter_id'])->first();
        $law->delete();
    }
    public function removeContractService($data){
        $law = $this->contractService->where('contract_id', $data['contract_id'])->where('renter_id', $data['renter_id'])->first();
        $law->delete();
    }

    public function duplicate($id){
        $motel = $this->contract->find($id);
        $newMotel = $motel->replicate();
        $newMotel->save();
        return $newMotel;
    }

    public function getById($id){
        return $this->contract->with(['rent' ,'renter', 'service'])->find($id);
    }
    public function getByIdContractRenter($id){
        return $this->contractRenter->find($id);
    }
    public function getByIdContractService($id){
        return $this->contractService->find($id);
    }

    public function getAll(){
        return $this->contract->orderBy('id', 'DESC')->get();
    }

}