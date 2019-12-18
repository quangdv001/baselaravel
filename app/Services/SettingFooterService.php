<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 11/5/2018
 * Time: 10:24 PM
 */

namespace App\Services;


use App\Models\SettingFooter;
use Exception;
use Illuminate\Support\Facades\DB;

class SettingFooterService
{
    private $service;

    const TYPE_SINGLE_PAGE = 0;
    const TYPE_GENERAL_INFO = 1;
    const TYPE_IMAGE = 2;
    const TYPE_TEXT = 3;
    const TYPE_SOCIAL = 4;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public function __construct(SettingFooter $service)
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

    public function delete($id)
    {
        $child = $this->service->where('parent_id', $id)->get();
        if (sizeof($child) > 0) {
            return false;
        } else {
            return $this->category->find($id)->delete();
        }
    }

    public function updatePosition($data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                DB::table('setting_footer')
                    ->where('id', $value['id'])
                    ->update(['position' => $value['position'], 'parent_id' => $value['parent_id']]);
            }
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getById($id)
    {
        return $this->service->find($id);
    }

    public function getByParentId($id)
    {
        return $this->category->where('parent_id', $id)->get();
    }

    public function getAll()
    {
        return $this->category
            ->orderBy('position', 'ASC')
            ->orderBy('id', 'ASC')
            ->get();
    }

    public function listPluck()
    {
        return $this->category->pluck('name', 'id')->toArray();
    }

    public function generateOptionSelect($listCategories, $parent_id = 0, $cate_id, $char = '')
    {
        $html = '';

        foreach ($listCategories as $key => $item) {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id) {
                $selected = $cate_id == $item['id'] ? 'selected' : '';
                $html .= '<option value="' . $item['id'] . '" ' . $selected . '>';
                $html .= $char . $item['name'];
                $html .= '</option>';

                // Xóa chuyên mục đã lặp
                unset($listCategories[$key]);
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $html .= $this->generateOptionSelect($listCategories, $item['id'], $cate_id, $char . '|---');
            }
        }
        return $html;
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
}
