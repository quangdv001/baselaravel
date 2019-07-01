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
use App\Models\Article;
use App\Models\ArticleImg;

class ArticleService
{
    private $article;
    private $articleImg;
    public function __construct(Article $article, ArticleImg $articleImg)
    {
        $this->article = $article;
        $this->articleImg = $articleImg;
    }

    public function search($data){
        $query = $this->article;
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
    public function findArticleBySlug($slug){
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->article->where('slug', $slug)->first();
        }
        return $query;
    }
    // END NA

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->article;
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
        $article = $this->article->find($id);
        $article->delete();
    }

    public function getById($id){
        return $this->article->find($id);
    }

    public function getAll(){
        return $this->article->orderBy('id', 'DESC')->get();
    }
    public function test(){
        return 1;
    }

    public function getBySlug($slug){
        return $this->article->where('slug',$slug)->where('status', 1)->first();
    }

    public function getListByCategory($category, $limit = 10){
        return $this->article->where('category_id', $category->id)->where('type', $category->type)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }

    public function getRelate($categoryId, $slug, $limit){
        return $this->article->where('category_id', $categoryId)->where('slug', '!=', $slug)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }

    public function createArticleImg($id, $data){
        
        try {
            DB::beginTransaction();
            $this->articleImg->where('article_id', $id)->delete();
            $dataImg = [];
            if(sizeof($data) > 0){
                foreach($data as $k => $v){
                    $dataImg[$k]['article_id'] = $id;
                    $dataImg[$k]['img'] = $v;
                }
            }
            $this->articleImg->insert($dataImg);
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getArticleImg($id){
        return $this->articleImg->where('article_id', $id)->pluck('img');
    }
}
