<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;


use App\Models\GroupPermission;
use App\Models\Permission;
use Exception;
use Illuminate\Support\Facades\DB;

class PermissionService
{
    private $group;
    private $permission;
    public function __construct(GroupPermission $groupPermission, Permission $permission)
    {
        $this->group = $groupPermission;
        $this->permission = $permission;
    }

    public function getAll(){
        $group = $this->group->all(['id','name']);
        if(sizeof($group) > 0){
            foreach($group as $v){
                $v->permission;
            }
        }
        return $group;
    }

    public function getGroupById($id){
        $group = $this->group->find($id);
        $group->permission;
        return $group;
    }

    public function createPermission($data)
    {
        try {
            DB::beginTransaction();
            $permission = $this->permission;
            foreach ($data as $key => $value) {
                $permission->$key = $value;
            }
            $permission->save();
            DB::commit();
            return $permission;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updatePermission($id, $data)
    {
        try {
            DB::beginTransaction();
            $permission = $this->permission->find($id);
            foreach ($data as $key => $value) {
                $permission->$key = $value;
            }
            $permission->save();
            DB::commit();
            return $permission;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function removePermission($id)
    {
        try {
            DB::beginTransaction();
            $permission = $this->permission->find($id)->delete();
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getPermissionByGroupId($id){
        return $this->permission->where('group_id', $id)->get();
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $group = $this->group;
            $group->name = $data['name'];
            $group->save();

            $groupId = $group->id;
            if(isset($data['pms']) && sizeof($data['pms']) > 0){
                foreach($data['pms'] as $k => $v){
                    $data['pms'][$k]['group_id'] = $groupId;
                }
                $this->permission->insert(array_values($data['pms']));
            }
            DB::commit();
            return $group;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, $data)
    {
        try {
            DB::beginTransaction();
            $group = $this->group->find($id);
            $group->name = $data['name'];
            $group->save();
            DB::commit();
            return $group;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function removeGroup($id)
    {
        try {
            DB::beginTransaction();
            $permission = $this->group->find($id)->delete();
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

}