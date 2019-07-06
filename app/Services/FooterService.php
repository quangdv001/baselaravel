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
use App\Models\Footer;

class FooterService
{
    private $footer;
    public function __construct(Footer $footer)
    {
        $this->footer = $footer ? $footer : new Footer;
    }

    public function getAll(){
        return $this->footer->orderBy('id', 'ASC')->get();
    }

    public function create($data)
    {
        try {
            DB::beginTransaction();
            $admin = $this->footer;
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
        return $this->footer->find($id);
    }
}