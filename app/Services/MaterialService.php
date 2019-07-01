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
use App\Models\Material;

class MaterialService
{
    private $material;
    public function __construct(Material $material)
    {
        $this->material = $material;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->material;
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
        $article = $this->material->find($id);
        $article->delete();
    }

    public function getById($id){
        return $this->material->find($id);
    }

    public function getAll(){
        return $this->material->orderBy('id', 'DESC')->get();
    }

}