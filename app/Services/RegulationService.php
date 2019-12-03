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
use App\Models\Image;
use App\Models\Regulation;

class RegulationService
{
    private $image;
    public function __construct(Regulation $image)
    {
        $this->image = $image;
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $image = $this->image;
            foreach ($data as $key => $value) {
                $image->$key = $value;
            }
            $image->save();
            DB::commit();
            return $image;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($image, $data)
    {
        try {
            DB::beginTransaction();
            foreach ($data as $key => $value) {
                $image->$key = $value;
            }
            $image->save();
            DB::commit();
            return $image;
        } catch (Exception  $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function remove($id){
        $image = $this->image->find($id);
        $image->delete();
    }

    public function getById($id){
        return $this->image->with('file')->find($id);
    }

    public function getAll(){
        return $this->image->where('status', 1)->orderBy('id', 'DESC')->with('file')->get();
    }

    public function listAll(){
        return $this->image->orderBy('id', 'DESC')->with('file')->get();
    }

}
