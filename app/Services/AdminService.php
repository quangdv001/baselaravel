<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;


use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;

class AdminService
{
    private $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function search($data){
        $query = $this->admin;
        if (isset($data['email']) && $data['email'] != '') {
            $query = $query->where('email', $data['email']);
        }
        if (isset($data['phone']) && $data['phone'] != '') {
            $query = $query->where('phone', $data['phone']);
        }
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('name', 'like', '%' . $data['name'] . '%');
        }
        if (isset($data['username']) && $data['username'] != '') {
            $query = $query->where('username', 'like', '%' . $data['username'] . '%');
        }
        if (isset($data['active']) && $data['active'] > -1) {
            $query = $query->where('active', $data['active']);
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
            $admin = $this->admin;
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

    public function getById($id){
        return $this->admin->find($id);
    }

    public function getAll(){
        return $this->admin->orderBy('id', 'DESC')->get();
    }

}