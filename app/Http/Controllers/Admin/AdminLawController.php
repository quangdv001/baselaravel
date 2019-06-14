<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\LawService;
use App\Http\Requests\Admin\LawRequest;
use App\Services\CategoryService;
use App\Services\TagService;

class AdminLawController extends AdminBaseController
{
    protected $law;
    protected $category;
    public function __construct(LawService $law, CategoryService $category, TagService $tagService)
    {
        parent::__construct();
        $this->law = $law;
        $this->category = $category;
        $this->tagService = $tagService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('title','status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        $dataS['type'] = 2;
        $law = $this->law->search($dataS);
        $listCategories = $this->category->listPluck();

        return view('admin.law.index')
            ->with('data', $law)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $law = $tagItem = [];
        $listTag = '';
        if($id > 0){
            $law = $this->law->getById($id);
            $tag = $law->tag;

            if(sizeof($tag) > 0){
                foreach($tag as $v){
                    $tagItem[] = $v->name;
                }
                $listTag = implode(',', $tagItem);
            }
        }

        $category = $this->category->getAll();
        $html = $this->category->generateOptionSelect($category, 0, $law ? $law->category_id : 0, '');
        return view('admin.law.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('data', $law);
    }

    public function postCreate(LawRequest $request, $id = 0){
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
            $data['type'] = 2;

            $res = $this->law->create($data);
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
                            $this->tagService->createLawTag($payload);
                        }
                    }
                    
                }
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $law = $this->law->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->law->update($law, $data);
            if($res){
                $this->tagService->removeLawTag($id);
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'article_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createLawTag($payload);
                        }
                    }
                }
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.law.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->law->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.law.getList')->with('success_message', $mess);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
