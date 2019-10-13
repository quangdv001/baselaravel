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
use App\Models\Product;
use App\Models\ProductCombo;
use App\Models\ProductImg;

class ProductService
{
    private $product;
    private $productImg;
    private $combo;
    public function __construct(Product $product, ProductImg $productImg, ProductCombo $combo)
    {
        $this->product = $product;
        $this->productImg = $productImg;
        $this->combo = $combo;
    }

    public function search($data){
        $query = $this->product;
        if (isset($data['ids']) && $data['ids'] != '') {
            $query = $query->whereIn('id', explode(',', $data['ids']));
        }
        if (isset($data['title']) && $data['title'] != '') {
            $query = $query->where('title', 'like', '%' . $data['title'] . '%');
        }
        if (isset($data['status']) && $data['status'] > -1) {
            $query = $query->where('status', $data['status']);
        }
        if (isset($data['category_id']) && $data['category_id'] > 0) {
            $query = $query->where('category_id', $data['category_id']);
        }
        if (isset($data['type']) && $data['type'] > -1) {
            $query = $query->where('type', $data['type']);
        }
        if (isset($data['sortBy']) && $data['sortBy'] != '') {
            $query = $query->orderBy($data['sortBy'], isset($data['sortOrder']) ? $data['sortOrder'] : 'DESC');
        } else {
            $query = $query->orderBy('id', 'DESC');
        }
        $admin = $query->paginate(isset($data['limit']) ? (int)$data['limit'] : 30);
        return $admin;
    }


    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->product;
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
        $article = $this->product->find($id);
        $article->delete();
    }

    public function getById($id){
        return $this->product->find($id);
    }

    public function getAll(){
        return $this->product->orderBy('id', 'DESC')->get();
    }

    public function createImg($id, $data){
        
        try {
            DB::beginTransaction();
            $this->productImg->where('product_id', $id)->delete();
            $dataImg = [];
            if(sizeof($data) > 0){
                foreach($data as $k => $v){
                    $dataImg[$k]['product_id'] = $id;
                    $dataImg[$k]['img'] = $v;
                }
            }
            $this->productImg->insert($dataImg);
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getImg($id){
        return $this->productImg->where('product_id', $id)->pluck('img');
    }

    public function getProductCombo(){
        return $this->product->where('is_combo', 0)->get();
    }

    public function getCombo($id){
        return $this->combo->where('combo_id', $id)->with('product')->get();
    }

    public function createCombo($id, $data){
        try {
            DB::beginTransaction();
            $this->combo->where('combo_id', $id)->delete();
            $params = [];
            if(sizeof($data) > 0){
                foreach($data as $k => $v){
                    $params[$k]['combo_id'] = $id;
                    $params[$k]['product_id'] = $v;
                }
                $this->combo->insert($params);
            }
            DB::commit();
            return true;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
