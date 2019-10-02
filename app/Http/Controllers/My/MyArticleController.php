<?php

namespace App\Http\Controllers\My;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\MotelService;
use Illuminate\Support\Facades\Storage;

class MyArticleController extends MyBaseController
{
    private $article;
    private $category;
    public function __construct(ArticleService $article, CategoryService $category)
    {
        parent::__construct();
        $this->article = $article;
        $this->category = $category;
    }

    public function index(Request $request){
        $params['user_id_c'] = $this->user->id;
        $data = $this->motel->search($params);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function show($id){
        $data = $this->article->getById($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function create(Request $request){
        $params = $request->only('title', 'slug', 'meta', 'type', 'short_description', 'description', 'status', 'category_id', 'img', 'file_path');
        $params['user_id_c'] = $this->user->id;
        $params['user_id_name'] = $this->user->name;
        $data = $this->article->create($params);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function duplicate(Request $request){
        $id = $request->input('id', 0);
        $data = $this->article->duplicate($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($data){
            $res['success'] = 1;
            $res['data'] = $data;
        }
        return response()->json($res);
    }

    public function update(Request $request, $id){
        $params = $request->only('title', 'slug', 'meta', 'type', 'short_description', 'description', 'status', 'category_id', 'img', 'file_path');
        $params['user_id_c'] = $this->user->id;
        $params['user_id_name'] = $this->user->name;
        $motel = $this->article->getById($id);
        $res['success'] = 0;
        $res['mess'] = 'Có lỗi xảy ra!';
        if($motel){
            $data = $this->article->update($motel, $params);
            if($data){
                $res['success'] = 1;
                $res['data'] = $data;
            }
        }
        return response()->json($res);
    }

    public function remove(Request $request){
        $id = $request->input('id', 0);
        $data = $this->article->remove($id);
        $res['success'] = 1;
        $res['data'] = $data;
        return response()->json($res);
    }

    public function uploadImage(Request $request){
        logger(2);
        $file = $request->file('file');
        logger($request->all());
        $time = time();
        // $data['folder_id'] = 0;
        // $data['name'] = $file->getClientOriginalName();
        $data['path'] = $time.'-'.$file->getClientOriginalName();
        logger($data['path']);
        // $data['type'] = $file->getClientOriginalExtension();
        Storage::putFileAs(
            'upload/files', $file, $data['path']
        );
        $img = Storage::url('upload/files/'.$data['path']);
        // $img = $this->file->createFile($data, $this->user, []);
        $res['success'] = 0;
        if($img){
            $res['success'] = 1;
            $res['img'] = $img;
        }
        return response()->json($res);
    }

    public function getCategory(){
        $category = $this->category->getAll();
        $res['success'] = 1;
        $res['data'] = $category;
        return response()->json($res);
    }
}
