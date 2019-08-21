<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;

use App\Models\Bill;
use App\Models\BillService as AppBillService;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Motel;
use App\Models\Rent;

class BillService
{
    public function __construct(Bill $bill, AppBillService $billService)
    {
        $this->bill = $bill;
        $this->billService = $billService;
    }

    public function search($data){
        $query = $this->bill;
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (isset($data['user_id']) && $data['user_id'] != '') {
            $query = $query->where('user_id', $data['user_id']);
        }
        if (isset($data['rent_id']) && $data['rent_id'] != '') {
            $query = $query->where('rent_id', $data['rent_id']);
        }
        if (isset($data['motel_id']) && $data['motel_id'] != '') {
            $query = $query->where('motel_id', $data['motel_id']);
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    public function searchBillService($data){
        $query = $this->billService;
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (isset($data['bill_id']) && $data['bill_id'] != '') {
            $query = $query->where('bill_id', $data['bill_id']);
        }
        if (isset($data['service_id']) && $data['service_id'] != '') {
            $query = $query->where('service_id', $data['service_id']);
        }
        if (isset($data['motel_id']) && $data['motel_id'] != '') {
            $query = $query->where('motel_id', $data['motel_id']);
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->bill;
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

    public function createBillService($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->billService;
            // foreach ($data as $key => $value) {
            //     $admin->$key = $value;
            // }
            $admin->insert($data);
            DB::commit();
            return true;
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
        $law = $this->bill->find($id);
        $law->delete();
    }

    public function removeBillService($id){
        $law = $this->billService->find($id);
        $law->delete();
    }

    public function duplicate($id){
        $motel = $this->bill->find($id);
        $newMotel = $motel->replicate();
        $newMotel->save();
        return $newMotel;
    }

    public function getById($id){
        return $this->bill->find($id);
    }
    
    public function getByIdBillService($id){
        return $this->billService->find($id);
    }

    public function getAll(){
        return $this->bill->orderBy('id', 'DESC')->get();
    }

}