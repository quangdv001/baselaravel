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
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderInfo;

class OrderService
{
    private $order;
    private $orderDetail;
    private $orderInfo;
    public function __construct(Order $order, OrderDetail $orderDetail, OrderInfo $orderInfo)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
        $this->orderInfo = $orderInfo;
    }

    public function search($data){
        $order = $this->order->getTable();
        $orderInfo = $this->orderInfo->getTable();
        $query = DB::table($order);
        $query->join($orderInfo, $order . '.id', '=', $orderInfo . '.order_id');
        if (isset($data['ids']) && $data['ids'] != '') {
            $query = $query->whereIn($order . '.id', explode(',', $data['ids']));
        }
        if (isset($data['name']) && $data['name'] != '') {
            $query = $query->where($orderInfo . '.name', 'like', '%' . $data['name'] . '%');
        }
        if (isset($data['phone']) && $data['phone'] != '') {
            $query = $query->where($orderInfo . '.phone', $data['phone']);
        }
        if (isset($data['status']) && $data['status'] > -1) {
            $query = $query->where($order . '.status', $data['status']);
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $query->select($order. '.*', $orderInfo. '.name', $orderInfo. '.phone');
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }


    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->order;
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
        $article = $this->order->find($id);
        $article->delete();
    }

    public function getById($id){
        return $this->order->find($id);
    }

    public function getAll(){
        return $this->order->orderBy('id', 'DESC')->get();
    }

}
