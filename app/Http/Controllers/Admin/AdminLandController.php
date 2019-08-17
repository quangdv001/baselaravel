<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\LandService;
use App\Http\Requests\Admin\LandRequest;
use App\Services\CategoryService;
use App\Services\TagService;

class AdminLandController extends AdminBaseController
{
    protected $land;
    protected $category;
    public function __construct(LandService $land, CategoryService $category, TagService $tagService)
    {
        parent::__construct();
        $this->land = $land;
        $this->category = $category;
        $this->tagService = $tagService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $firstCate = json_decode($this->category->getBySlug('nha-dat-ha-noi'), TRUE);
        $request->flash();
        $dataS = $request->only('title', 'category_id', 'status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        if(isset($dataS['category_id']) && $dataS['category_id'] == $firstCate['id']) {
            unset($dataS['category_id']);
        }
        $status = isset($dataS['status']) ? $dataS['status'] : 1;
        $cateIdSearch = isset($dataS['category_id']) ? $dataS['category_id'] : $firstCate['id'];
        $land = $this->land->search($dataS);
        $categoriesSearch = $this->category->getChild($firstCate['id']);
        array_unshift($categoriesSearch, $firstCate);
        $listCategories = $this->category->listPluckByCategory($firstCate['id']);
        return view('admin.land.index')
            ->with('data', $land)
            ->with('status', $status)
            ->with('cateIdSearch', $cateIdSearch)
            ->with('categoriesSearch', $categoriesSearch)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $land = $tagItem = [];
        $listTag = '';
        if($id > 0){
            $land = $this->land->getById($id);
            $tag = $land->tag;

            if(sizeof($tag) > 0){
                foreach($tag as $v){
                    $tagItem[] = $v->name;
                }
                $listTag = implode(',', $tagItem);
            }
        }
        $firstCate = json_decode($this->category->getBySlug('nha-dat-ha-noi'), TRUE);
        $category = $this->category->getChild($firstCate['id']);
        array_unshift($category, $firstCate);
        $html = $this->category->generateOptionSelect($category, 1, $land ? $land->category_id : 0, '');
        return view('admin.land.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('data', $land);
    }

    public function postCreate(LandRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'meta', 'type', 'short_description', 'description', 'status', 'category_id', 'img', 'tag', 'file_path');
        $listTags = $data['tag'];
        unset($data['tag']);
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            
            $res = $this->land->create($data);
            if($res){
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'land_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createLandTag($payload);
                        }
                    }
                    
                }
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $land = $this->land->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->land->update($land, $data);
            if($res){
                $this->tagService->removeLandTag($id);
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'land_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createLandTag($payload);
                        }
                    }
                }
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.land.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->land->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.land.getList')->with('success_message', $mess);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
