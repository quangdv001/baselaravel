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
use App\User;

class UserService
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function search($data){
        $query = $this->user;
        if (isset($data['email']) && $data['email'] != '') {
            $query = $query->where('email', $data['email']);
        }
        if (isset($data['phone']) && $data['phone'] != '') {
            $query = $query->where('phone', $data['phone']);
        }
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('name', 'like', '%' . $data['name'] . '%');
        }
        if (isset($data['status']) && $data['status'] > -1) {
            $query = $query->where('status', $data['status']);
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
            $user = $this->user;
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            $user->save();
            DB::commit();
            return $user;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($user, $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $user->$key = $value;
            }
            $user->save();
            DB::commit();
            return $user;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById($id){
        return $this->user->find($id);
    }

    public function getAll(){
        return $this->user->orderBy('id', 'DESC')->get();
    }

    public function getByEmail($email){
        return $this->user->where('email', $email)->first();
    }

}