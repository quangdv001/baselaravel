<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;

use App\Models\Bill;
use App\Models\BillService as ModelsBillService;
use Exception;
use Illuminate\Support\Facades\DB;

class BillService
{
    private $repo;
    private $billService;
    public function __construct(Bill $repo, ModelsBillService $billService)
    {
        $this->repo = $repo;
        $this->billService = $billService;
    }

    public function search($data){
        $query = $this->repo;
        if (isset($data['contract_id']) && $data['contract_id'] > 0) {
            $query = $query->where('contract_id', $data['contract_id']);
        }
        if (isset($data['user_id']) && $data['user_id'] > 0) {
            $query = $query->where('user_id', $data['user_id']);
        }
        if (isset($data['except']) && $data['except'] > 0) {
            $query = $query->where('id', '<>' ,$data['except']);
        }
        if (isset($data['type']) && $data['type'] > -1) {
            $query = $query->where('type', $data['type']);
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->with('contract.room')->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    public function create($data, $service)
    {
        try {
            DB::beginTransaction();
            $admin = $this->repo;
            foreach ($data as $key => $value) {
                $admin->$key = $value;
            }
            $admin->save();
            if($admin && sizeof($service) > 0){
                foreach($service as $k => $v){
                    $service[$k]['bill_id'] = $admin->id;
                }
                $this->billService->insert($service);
            }
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
        $article = $this->repo->find($id);
        if($article){
            $article->delete();
        }
        return true;
    }

    public function getById($id){
        return $this->repo->with('category')->find($id);
    }

    public function getAll(){
        return $this->repo->orderBy('id', 'DESC')->get();
    }

    public function get($condition)
    {
        $query = $this->repo;
        foreach ($condition as $key => $value) {
            if (is_array($value)) {
                $query = $query->whereIn($key, $value);
            } else {
                $query = $query->where($key, $value);
            }
        }
        $data = $query->get();
        return $data;
    }

    public function first($condition)
    {
        $query = $this->repo;
        foreach ($condition as $key => $value) {
            if (is_array($value)) {
                $query = $query->whereIn($key, $value);
            } else {
                $query = $query->where($key, $value);
            }
        }
        $data = $query->first();
        return $data;
    }

    public function list($condition, $field, $key = '')
    {
        $query = $this->repo;
        foreach ($condition as $k => $value) {
            if (is_array($value)) {
                $query = $query->whereIn($k, $value);
            } else {
                $query = $query->where($k, $value);
            }
        }
        if ($key != '') {
            $data = $query->pluck($field, $key);
        } else {
            $data = $query->pluck($field);
        }
        return $data;
    }
}
