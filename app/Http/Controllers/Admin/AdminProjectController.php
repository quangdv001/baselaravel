<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ProjectService;
use App\Http\Requests\Admin\ProjectRequest;
use App\Services\CategoryService;
use App\Services\TagService;

class AdminProjectController extends AdminBaseController
{
    protected $project;
    protected $category;
    public function __construct(ProjectService $project, CategoryService $category, TagService $tagService)
    {
        parent::__construct();
        $this->project = $project;
        $this->category = $category;
        $this->tagService = $tagService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $firstCate = json_decode($this->category->getBySlug('do-thi'), TRUE);
        $request->flash();
        $dataS = $request->only('title', 'category_id', 'status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        if(isset($dataS['category_id']) && $dataS['category_id'] == $firstCate['id']) {
            unset($dataS['category_id']);
        }
        $status = isset($dataS['status']) ? $dataS['status'] : 1;
        $cateIdSearch = isset($dataS['category_id']) ? $dataS['category_id'] : $firstCate['id'];
        $project = $this->project->search($dataS);
        $categoriesSearch = $this->category->getChild($firstCate['id']);
        array_unshift($categoriesSearch, $firstCate);
        $listCategories = $this->category->listPluckByCategory($firstCate['id']);
        return view('admin.project.index')
            ->with('data', $project)
            ->with('status', $status)
            ->with('cateIdSearch', $cateIdSearch)
            ->with('categoriesSearch', $categoriesSearch)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $project = $tagItem = [];
        $listTag = '';
        if($id > 0){
            $project = $this->project->getById($id);
            $tag = $project->tag;

            if(sizeof($tag) > 0){
                foreach($tag as $v){
                    $tagItem[] = $v->name;
                }
                $listTag = implode(',', $tagItem);
            }
        }

        $firstCate = json_decode($this->category->getBySlug('do-thi'), TRUE);
        $category = $this->category->getChild($firstCate['id']);
        array_unshift($category, $firstCate);
        $html = $this->category->generateOptionSelect($category, 1, $project ? $project->category_id : 0, '');
        return view('admin.project.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('data', $project);
    }

    public function postCreate(ProjectRequest $request, $id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $data = $request->only('title', 'slug', 'meta', 'short_description', 'description', 'status', 'category_id', 'img', 'tag', 'file_path');
        $listTags = $data['tag'];
        unset($data['tag']);
        $mess = '';
        if($id == 0){
            $data['admin_id_c'] = $this->user->id;
            $data['admin_name_c'] = $this->user->username;
            
            $res = $this->project->create($data);
            if($res){
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'article_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createProjectTag($payload);
                        }
                    }
                    
                }
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $project = $this->project->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->project->update($project, $data);
            if($res){
                $this->tagService->removeProjectTag($id);
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'article_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createProjectTag($payload);
                        }
                    }
                }
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.project.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->project->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.project.getList')->with('success_message', $mess);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
