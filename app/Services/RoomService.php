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

class RoomService
{
    private $room;
    public function __construct(Room $room)
    {
        $this->room = $room;
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
        $query = null;
        if (isset($slug) && $slug != '') {
            $query = $this->room->where('slug', $slug)->where('status',1)->first();
        }
        return $query;
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

}