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
use App\Models\Land;

class LandService
{
    private $land;
    public function __construct(Land $land)
    {
        $this->land = $land ? $land : new Land;
    }

    public function search($data){
        $query = $this->land;
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
        if (isset($data['category_id']) && $data['category_id'] != '') {
            $query = $query->where('category_id', $data['category_id']);
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
    public function latestByType($typeId = 0) {
        $land = $this->land;
        return $land->select()
            ->where('type', '=', $typeId )
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findLandBySlug($slug){
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->land->where('slug', $slug)->first();
        }
        return $query;
    }
    // END NA

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->land;
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
        $land = $this->land->find($id);
        $land->delete();
    }

    public function getById($id){
        return $this->land->find($id);
    }

    public function getAll(){
        return $this->land->orderBy('id', 'DESC')->get();
    }
    public function test(){
        return 1;
    }

    public function getBySlug($slug){
        return $this->land->where('slug',$slug)->where('status', 1)->first();
    }

    public function getListByCategory($category, $limit = 10){
        return $this->land->where('category_id', $category->id)->where('type', $category->type)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }

    public function getRelate($categoryId, $slug, $limit){
        return $this->land->where('category_id', $categoryId)->where('slug', '!=', $slug)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }
}