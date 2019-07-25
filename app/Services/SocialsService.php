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
use App\Models\Socials;

class SocialsService
{
    private $socials;
    public function __construct(Socials $socials)
    {
        $this->socials = $socials;
    }

    public function search($data){
        $query = $this->socials;
        if (isset($data['title']) && $data['title'] != '') {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (isset($data['user_name_c']) && $data['user_name_c'] != '') {
            $query = $query->where('user_name_c', 'like', '%' . $data['user_name_c'] . '%');
        }
        if (isset($data['admin_name_c']) && $data['admin_name_c'] != '') {
            $query = $query->where('admin_name_c', 'like', '%' . $data['admin_name_c'] . '%');
        }
        if (isset($data['status']) && $data['status'] > -1) {
            $query = $query->where('status', $data['status']);
        }
        if (isset($data['category_id']) && $data['category_id'] > -1) {
            $query = $query->where('category_id', $data['category_id']);
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
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    // NA
    public function findSocialsBySlug($slug){
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->socials->where('slug', $slug)->first();
        }
        return $query;
    }
    // END NA

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $socials = $this->socials;
            foreach ($data as $key => $value) {
                $socials->$key = $value;
            }
            $socials->save();
            DB::commit();
            return $socials;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($socials, $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $socials->$key = $value;
            }
            $socials->save();
            DB::commit();
            return $socials;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function remove($id){
        $socials = $this->socials->find($id);
        $socials->delete();
    }

    public function getById($id){
        return $this->socials->find($id);
    }

    public function getAll(){
        return $this->socials->orderBy('id', 'ASC')->get();
    }

    public function getBySlug($slug){
        return $this->socials->where('slug',$slug)->where('status', 1)->first();
    }
}
