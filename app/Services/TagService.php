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
use App\Models\ArticleTag;
use App\Models\Tag;

class TagService
{
    private $article;
    public function __construct(ArticleTag $article_tag, Tag $tag)
    {
        $this->article_tag = $article_tag;
        $this->tag = $tag;
    }

    public function createTag($listTag)
    {
        try {
            DB::beginTransaction();
            $tag = $this->tag;
            $tag->name = $listTag;
            $tag->save();
            DB::commit();
            return $tag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createArticleTag($data)
    {
        try {
            DB::beginTransaction();
            $articleTag = new ArticleTag();
            foreach ($data as $key => $value) {
                $articleTag->$key = $value;
            }
            $articleTag->save();
            DB::commit();
            return $articleTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateTag($tag, $listTag)
    {
        try {
            DB::beginTransaction();
            $tag->name = $listTag;
            $tag->save();
            DB::commit();
            return $tag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getArticleTagByArticleId($id){
        return $this->article_tag->where('article_id', $id)->get();
    }

    public function getListTagByArticleTagId($id){
        return $this->tag->find($id);
    }

    public function getCreateTagByName($name){
        try {
            DB::beginTransaction();
            $tag = $this->tag->where('name', $name)->first();
            if($tag){
                DB::commit();
                return $tag;
            } else {
                $newTag = $this->createTag($name);
                DB::commit();
                return $newTag;
            }
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function removeArticleTag($id){
        try {
            DB::beginTransaction();
            $articleTag = $this->article_tag->where('article_id', $id)->delete();
            DB::commit();
            return $articleTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

}