<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;

use App\Models\GeneralInfo;
use Exception;
use Illuminate\Support\Facades\DB;

class GeneralInfoService
{
    private $service;

    const TYPE_TEXT = 0;
    const TYPE_SOCIAL = 1;
    const TYPE_IMAGE = 2;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function __construct(GeneralInfo $service)
    {
        $this->service = $service;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $query = $this->service;
            foreach ($data as $key => $value) {
                $query->$key = $value;
            }
            $query->save();
            DB::commit();
            return $query;
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

    public function getById($id)
    {
        return $this->service->find($id);
    }

    public function get($data)
    {
        $query = $this->service;
        if (isset($data['select']) && count($data['select']) > 0) {
            $query = $query->select($data['select']);
        }
        if (isset($data['conditions']) && count($data['conditions']) > 0) {
            $conditions = $data['conditions'];
            foreach ($conditions as $condition) {
                $operation = !empty($condition['operation']) ? $condition['operation'] : '=';
                switch ($operation) {
                    case 'like':
                        $query = $query->where($condition['key'], $operation, '%' . $condition['value'] . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($condition['key'], $condition['value']);
                        break;
                    default:
                        $query = $query->where($condition['key'], $operation, $condition['value']);
                }
            }
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        }
        $data = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $data;
    }

    public function first($data)
    {
        $query = $this->service;
        if (isset($data['select']) && count($data['select']) > 0) {
            $query = $query->select($data['select']);
        }
        if (isset($data['conditions']) && count($data['conditions']) > 0) {
            $conditions = $data['conditions'];
            foreach ($conditions as $condition) {
                $operation = !empty($condition['operation']) ? $condition['operation'] : '=';
                switch ($operation) {
                    case 'like':
                        $query = $query->where($condition['key'], $operation, '%' . $condition['value'] . '%');
                        break;
                    case 'in':
                        $query = $query->whereIn($condition['key'], $condition['value']);
                        break;
                    default:
                        $query = $query->where($condition['key'], $operation, $condition['value']);
                }
            }
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        }
        $data = $query->first();
        return $data;
    }

    public function remove($id)
    {
        $info = $this->service->find($id);
        if ($info) {
            $info->delete();
        }
        return true;
    }
}
