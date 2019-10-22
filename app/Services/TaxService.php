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
use App\Models\Tax;

class TaxService
{
    private $tax;
    public function __construct(Tax $tax)
    {
        $this->tax = $tax ? $tax : new Tax;
    }

    public function search($data){
        $query = $this->tax;
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
        } elseif (isset($data['random']) && $data['random'] == 1) {
            $query = $query->inRandomOrder();
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    // NA
    public function latestByType($typeId = 0) {
        $tax = $this->tax;
        return $tax->select()
            ->where('type', '=', $typeId )
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findTaxBySlug($slug){
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->tax->where('slug', $slug)->first();
        }
        return $query;
    }
    // END NA

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->tax;
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
        $tax = $this->tax->find($id);
        $tax->delete();
    }

    public function getById($id){
        return $this->tax->find($id);
    }

    public function getAll(){
        return $this->tax->orderBy('id', 'DESC')->get();
    }
    public function test(){
        return 1;
    }

    public function getBySlug($slug){
        return $this->tax->where('slug',$slug)->where('status', 1)->first();
    }

    public function getListByCategory($category, $limit = 10){
        return $this->tax->where('category_id', $category->id)->where('type', $category->type)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }

    public function getRelate($categoryId, $slug, $limit){
        return $this->tax->where('category_id', $categoryId)->where('slug', '!=', $slug)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }
}