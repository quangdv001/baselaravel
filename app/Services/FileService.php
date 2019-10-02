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
use App\Models\File;
use App\Models\Folder;

class FileService
{
    private $file;
    private $folder;
    public function __construct(File $file, Folder $folder)
    {
        $this->file = $file;
        $this->folder = $folder;
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

    public function createFile($data, $admin = [], $user = [])
    {
        try {
            DB::beginTransaction();
            $file = $this->file;
            foreach ($data as $key => $value) {
                $file->$key = $value;
            }
            if($admin){
                $file->admin_id_c = $admin->id;
                $file->admin_name_c = $admin->username;
            }
            if($user){
                $file->user_id_c = $user->id;
                $file->user_name_c = $user->username;
            }
            $file->save();
            DB::commit();
            return $file;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateFile($file, $data, $admin, $user)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $file->$key = $value;
            }
            if($admin){
                $file->admin_id_u = $admin->id;
                $file->admin_name_u = $admin->username;
            }
            if($user){
                $file->user_id_u = $user->id;
                $file->user_name_u = $user->name;
            }
            $file->save();
            DB::commit();
            return $file;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function createFolder($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->folder;
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

    public function updateFolder($admin, $data)
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

    public function removeFile($file){
        return $file->delete();
    }

    public function getFileById($id){
        return $this->file->find($id);
    }

    public function getFolderById($id){
        return $this->folder->find($id);
    }

    public function getFileByFolder($folder = 0){
        return $this->file->where('folder_id', $folder)->orderBy('position', 'ASC')->orderBy('id', 'ASC')->get();
    }

}