<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ExchangeService;
use App\Http\Requests\Admin\ExchangeRequest;
use App\Services\CategoryService;
use App\Services\TagService;

class AdminExchangeController extends AdminBaseController
{
    protected $exchange;
    protected $category;
    public function __construct(ExchangeService $exchange, CategoryService $category, TagService $tagService)
    {
        parent::__construct();
        $this->exchange = $exchange;
        $this->category = $category;
        $this->tagService = $tagService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('title', 'status', 'user_name_c', 'admin_name_c');
        $dataS['limit'] = 10;
        $exchange = $this->exchange->search($dataS);
        $listCategories = $this->category->listPluck();

        return view('admin.exchange.index')
            ->with('data', $exchange)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $exchange = $tagItem = [];
        $listTag = '';
        if($id > 0){
            $exchange = $this->exchange->getById($id);
            $tag = $exchange->tag;

            if(sizeof($tag) > 0){
                foreach($tag as $v){
                    $tagItem[] = $v->name;
                }
                $listTag = implode(',', $tagItem);
            }
        }
        $category = $this->category->getBySlug('moi-gioi-san-giao-dich');
        $html = '<option value="'.$category->id.'" selected>'.$category->name.'</option>';
        
        return view('admin.exchange.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('data', $exchange);
    }

    public function postCreate(ExchangeRequest $request, $id = 0){
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
            
            $res = $this->exchange->create($data);
            if($res){
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'exchange_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createExchangeTag($payload);
                        }
                    }
                    
                }
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $exchange = $this->exchange->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->exchange->update($exchange, $data);
            if($res){
                $this->tagService->removeExchangeTag($id);
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'exchange_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createExchangeTag($payload);
                        }
                    }
                }
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.exchange.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->exchange->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.exchange.getList')->with('success_message', $mess);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
