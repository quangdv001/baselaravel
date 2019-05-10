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

    public function getAll(){
        return $this->category->orderBy('position', 'ASC')->orderBy('id', 'ASC')->get();
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

    public function genMenu($category, $parentId = 0, $char = ''){
        $html = '<ol>';
        foreach($category as $k => $v){
            if($v['parent_id'] == $parentId){
                $html .= '<li><a href="#">' . $v['name'] . '</a></li>';
                unset($category[$k]);
                $html.= $this->genMenu($category, $v['id'], $char.'|-');
            }
        }
        $html .= '</ol>';
        return $html;
    }

    public function getMenu($category, $parentId = 0){
        $menu = [];
        $index = 0;
        foreach($category as $k => $v){
            if($v['parent_id'] == $parentId){
                unset($category[$k]);
                $submenu = $this->getMenu($category, $v['id']);
                if ($submenu) {
                    $v->submenu = $submenu;
                }
                $menu[] = $v;
                $index++;
            }
        }
        return $menu;        
    }

    public function getBySlug($slug){
        return $this->category->where('slug',$slug)->first();
    }

}