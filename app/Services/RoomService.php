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
use App\Models\Room;
use App\Models\RoomImg;

class RoomService
{
    private $room;
    private $roomImg;
    public function __construct(Room $room, RoomImg $roomImg)
    {
        $this->room = $room;
        $this->roomImg = $roomImg;
    }

    public function search($data){
        $query = $this->room;
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
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }

    // NA
    public function getBySlug($slug){
        return $this->room->where('slug', $slug)->where('status',1)->first();
    }
    // End NA

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->room;
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

    public function createArticleImg($id, $data){
        
        try {
            DB::beginTransaction();
            $this->roomImg->where('room_id', $id)->delete();
            $dataImg = [];
            if(sizeof($data) > 0){
                foreach($data as $k => $v){
                    $dataImg[$k]['room_id'] = $id;
                    $dataImg[$k]['img'] = $v;
                }
            }
            $this->roomImg->insert($dataImg);
            DB::commit();
            return true;
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
        $article = $this->room->find($id);
        $article->delete();
    }

    public function getById($id){
        return $this->room->find($id);
    }

    public function getAll(){
        return $this->room->orderBy('id', 'DESC')->get();
    }

    public function getRelate($categoryId, $slug, $limit){
        return $this->room->where('category_id', $categoryId)->where('slug', '!=', $slug)->where('status',1)->orderBy('id','DESC')->paginate($limit);
    }
}