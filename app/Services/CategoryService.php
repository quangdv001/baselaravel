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
use App\Models\Category;

class CategoryService
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function search($data){
        $query = $this->category;
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where('name', 'like', '%' . $data['name'] . '%');
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

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->category;
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

    public function delete($id){
        $child = $this->category->where('parent_id', $id)->get();
        if(sizeof($child) > 0){
            return false;
        } else {
            return $this->category->find($id)->delete();
        }
    }

    public function updatePosition($data){
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                DB::table('category')
                ->where('id', $value['id'])
                ->update(['position' => $value['position'], 'parent_id' => $value['parent_id']]);
            }
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById($id){
        return $this->category->find($id);
    }

    public function getByParentId($id){
        return $this->category->where('parent_id', $id)->get();
    }

    public function getAll(){
        return $this->category
                    ->orderBy('position', 'ASC')
                    ->orderBy('id', 'ASC')
                    ->get();
    }

    public function listPluck(){
        return $this->category->pluck('name','id')->toArray();
    }

    public function generateOptionSelect($listCategories, $parent_id = 0, $cate_id, $char = ''){
        $html = '';
        
        foreach ($listCategories as $key => $item){
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id){
                $selected = $cate_id == $item['id'] ? 'selected' : '';
                $html.= '<option value="'.$item['id'].'" '. $selected .'>';
                    $html.= $char.$item['name'];
                $html.= '</option>';
                
                // Xóa chuyên mục đã lặp
                unset($listCategories[$key]);
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $html.= $this->generateOptionSelect($listCategories, $item['id'], $cate_id, $char.'|---');
            }
        }
        return $html;
    }

    public function getBySlug($slug){
        return $this->category->where('slug',$slug)->first();
    }

    public function get($condition)
    {
        $query = $this->category;
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
        $query = $this->category;
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
        $query = $this->category;
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