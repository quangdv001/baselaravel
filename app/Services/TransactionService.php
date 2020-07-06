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
use App\Models\Service;
use App\Models\Transaction;

class TransactionService
{
    private $repo;
    public function __construct(Transaction $repo)
    {
        $this->repo = $repo;
    }

    public function search($data){
        $query = $this->repo->with('user');
        if (isset($data['from']) && $data['from'] > 0) {
            $query = $query->where('created_time', '>=' , $data['from']);
        }
        if (isset($data['to']) && $data['to'] > 0) {
            $query = $query->where('created_time', '<=' , $data['to']);
        }
        $query = $query->whereHas('user', function($q) use ($data){
            if(isset($data['name']) && $data['name'] != ''){
                $q->where('name', 'like', '%' . $data['name'] . '%');
            }
            if(isset($data['email']) && $data['email'] != ''){
                $q->where('email', 'like', '%' . $data['email'] . '%');
            }
        });
        
        
        
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
            $admin = $this->repo;
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
        $article = $this->repo->find($id);
        if($article){
            $article->delete();
        }
        return true;
    }

    public function getById($id){
        return $this->repo->find($id);
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
