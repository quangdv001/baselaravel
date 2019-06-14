<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Services\ArticleService;
use App\Http\Requests\Admin\ArticleRequest;
use App\Services\CategoryService;
use App\Services\TagService;

class AdminArticleController extends AdminBaseController
{
    protected $article;
    protected $category;
    public function __construct(ArticleService $article, CategoryService $category, TagService $tagService)
    {
        parent::__construct();
        $this->article = $article;
        $this->category = $category;
        $this->tagService = $tagService;
    }

    public function index(Request $request){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $request->flash();
        $dataS = $request->only('title','type','status','user_name_c','admin_name_c');
        $dataS['limit'] = 10;
        if (!isset($dataS['type'])) {
            $dataS['type'] = [1,4];
        }
        $article = $this->article->search($dataS);
        $listCategories = $this->category->listPluck();

        return view('admin.article.index')
            ->with('data', $article)
            ->with('listCategories', $listCategories);
    }

    public function getCreate($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền vào trang này!');
        }
        $article = $tagItem = [];
        $listTag = '';
        if($id > 0){
            $article = $this->article->getById($id);
            $tag = $article->tag;

            if(sizeof($tag) > 0){
                foreach($tag as $v){
                    $tagItem[] = $v->name;
                }
                $listTag = implode(',', $tagItem);
            }
        }

        $category = $this->category->getAll();
        $html = $this->category->generateOptionSelect($category, 0, $article ? $article->category_id : 0, '');
        return view('admin.article.edit')
            ->with('id', $id)
            ->with('html', $html)
            ->with('listTag', $listTag)
            ->with('data', $article);
    }

    public function postCreate(ArticleRequest $request, $id = 0){
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
            
            $res = $this->article->create($data);
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
                            $this->tagService->createArticleTag($payload);
                        }
                    }
                    
                }
                $mess = 'Tạo bài viết thành công';
            }
        } else {
            $article = $this->article->getById($id);
            $data['admin_id_u'] = $this->user->id;
            $data['admin_name_u'] = $this->user->username;
            $res = $this->article->update($article, $data);
            if($res){
                $this->tagService->removeArticleTag($id);
                $arrTag = explode(',', $listTags);
                if(sizeof($arrTag) > 0){
                    foreach($arrTag as $v){
                        $tag = $this->tagService->getCreateTagByName($v);
                        if($tag){
                            $payload = array(
                                'article_id'=> $res->id,
                                'tag_id'=> $tag->id
                            );
                            $this->tagService->createArticleTag($payload);
                        }
                    }
                }
                $mess = 'Cập nhật bài viết thành công';
            }
        }
        return redirect()->route('admin.article.getList')->with('success_message', $mess);
    }

    public function remove($id = 0){
        if (Gate::forUser($this->user)->denies('admin-pms', $this->currentRoute)) {
            return redirect()->route('admin.home.dashboard')->with('error_message','Bạn không có quyền xóa bài viết này!');
        }
        $this->article->remove($id);
        $mess = 'Xóa bài viết thành công';
        return redirect()->route('admin.article.getList')->with('success_message', $mess);
    }

    public function getByType($type = null) {
        if ($type === null) {
            return $this->all();
        }
    }
}
