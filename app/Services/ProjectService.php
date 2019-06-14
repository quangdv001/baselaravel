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
use App\Models\Project;

class ProjectService
{
    private $project;
    public function __construct(Project $project)
    {
        $this->project = $project ? $project : new Project;
    }

    public function search($data){
        $query = $this->project;
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
    public function latestByType($typeId = 0) {
        $project = $this->project;
        return $project->select()
            ->where('type', '=', $typeId )
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findProjectBySlug($slug){
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->project->where('slug', $slug)->first();
        }
        return $query;
    }
    // END NA

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->project;
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
        $project = $this->project->find($id);
        $project->delete();
    }

    public function getById($id){
        return $this->project->find($id);
    }

    public function getAll(){
        return $this->project->orderBy('id', 'DESC')->get();
    }
    public function test(){
        return 1;
    }

    public function getBySlug($slug){
        return $this->project->where('slug',$slug)->where('status', 1)->first();
    }

    public function getListByCategory($category, $limit = 10){
        return $this->project->where('category_id', $category->id)->where('type', $category->type)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }

    public function getRelate($categoryId, $slug, $limit){
        return $this->project->where('category_id', $categoryId)->where('slug', '!=', $slug)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }
}