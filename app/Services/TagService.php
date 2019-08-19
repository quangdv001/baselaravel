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
use App\Models\RoomTag;
use App\Models\LawTag;
use App\Models\ProjectTag;
use App\Models\LandTag;
use App\Models\ExchangeTag;

class TagService
{
    private $roomTag;
    private $tag;
    private $article_tag;
    private $law_tag;
    private $project_tag;
    public function __construct(ArticleTag $article_tag, Tag $tag, RoomTag $roomTag, LawTag $law_tag, ProjectTag $project_tag)
    {
        $this->article_tag = $article_tag;
        $this->tag = $tag;
        $this->roomTag = $roomTag;
        $this->law_tag = $law_tag;
        $this->project_tag = $project_tag;
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

    public function createLandTag($data)
    {
        try {
            DB::beginTransaction();
            $landTag = new LandTag();
            foreach ($data as $key => $value) {
                $landTag->$key = $value;
            }
            $landTag->save();
            DB::commit();
            return $landTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createExchangeTag($data)
    {
        try {
            DB::beginTransaction();
            $exchangeTag = new ExchangeTag();
            foreach ($data as $key => $value) {
                $exchangeTag->$key = $value;
            }
            $exchangeTag->save();
            DB::commit();
            return $exchangeTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createLawTag($data)
    {
        try {
            DB::beginTransaction();
            $lawTag = new LawTag();
            foreach ($data as $key => $value) {
                $lawTag->$key = $value;
            }
            $lawTag->save();
            DB::commit();
            return $lawTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createProjectTag($data)
    {
        try {
            DB::beginTransaction();
            $projectTag = new ProjectTag();
            foreach ($data as $key => $value) {
                $projectTag->$key = $value;
            }
            $projectTag->save();
            DB::commit();
            return $projectTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createRoomTag($data)
    {
        try {
            DB::beginTransaction();
            $articleTag = new RoomTag();
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

    public function getLawTagByLawId($id){
        return $this->law_tag->where('article_id', $id)->get();
    }

    public function getProjectTagByProjectId($id){
        return $this->project_tag->where('article_id', $id)->get();
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

    public function removeLawTag($id){
        try {
            DB::beginTransaction();
            $lawTag = $this->law_tag->where('article_id', $id)->delete();
            DB::commit();
            return $lawTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function removeProjectTag($id){
        try {
            DB::beginTransaction();
            $projectTag = $this->project_tag->where('article_id', $id)->delete();
            DB::commit();
            return $projectTag;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function removeRoomTag($id){
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