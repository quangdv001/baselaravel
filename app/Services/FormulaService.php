<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;

use App\Models\Formula;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Motel;
use App\Models\Service;

class FormulaService
{
    public function __construct(Formula $formula)
    {
        $this->formula = $formula;
    }

    public function search($data){
        $query = $this->formula;
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (isset($data['user_id']) && $data['user_id'] != '') {
            $query = $query->where('user_id', $data['user_id']);
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
            $admin = $this->formula;
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
        $law = $this->formula->find($id);
        $law->delete();
    }

    public function duplicate($id){
        $motel = $this->formula->find($id);
        $newMotel = $motel->replicate();
        $newMotel->save();
        return $newMotel;
    }

    public function getById($id){
        return $this->formula->find($id);
    }

    public function getAll(){
        return $this->formula->orderBy('id', 'DESC')->get();
    }

}