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
use App\Models\ManagerLinksFooter;

class ManagerService
{
    private $manager;
    public function __construct(ManagerLinksFooter $manager)
    {
        $this->manager = $manager ? $manager : new Manager;
    }

    public function getAll(){
        return $this->manager->orderBy('id', 'ASC')->get();
    }

    public function getBySlug($slug){
        return $this->manager->where('slug', $slug)->where('status',1)->first();
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->manager;
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

    public function getById($id){
        return $this->manager->find($id);
    }
}