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
use App\Models\Page;
use App\Models\PageTranslation;

class PageService
{
    private $page;
    private $pageTrans;
    public function __construct(Page $page, PageTranslation $pageTrans)
    {
        $this->page = $page;
        $this->pageTrans = $pageTrans;
    }

    public function search($data){
        $query = $this->page;
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
    public function findPageBySlug($slug){
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->page->where('slug', $slug)->first();
        }
        return $query;
    }
    // END NA

    public function create($data, $dataTrans, $locale)
    {
        try {
            DB::beginTransaction();
            $page = $this->page;
            foreach ($data as $key => $value) {
                $page->$key = $value;
            }
            $page->save();
            foreach($dataTrans as $k => $v){
                $page->translateOrNew($locale)->$k = $v;
            }
            $page->save();
            DB::commit();
            return $page;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($page, $data, $dataTrans, $locale)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $page->$key = $value;
            }
            $page->save();
            foreach($dataTrans as $k => $v){
                $page->translateOrNew($locale)->$k = $v;
            }
            $page->save();
            DB::commit();
            return $page;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function remove($id){
        $page = $this->page->find($id);
        $page->delete();
    }

    public function getById($id){
        return $this->page->find($id);
    }

    public function getAll(){
        return $this->page->orderBy('id', 'DESC')->get();
    }
    public function test(){
        return 1;
    }

    public function getAllByLocale($locale) {
        return $this->page->join('page_translation', 'page.id', '=', 'page_translation.page_id')->where('locale', $locale)->where('status', 1)->get();
    }

    public function getBySlug($slug){
        return $this->page->join('page_translation', 'page.id', '=', 'page_translation.page_id')->where('slug',$slug)->where('status', 1)->first();
    }
}
