<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\CategoryService;
use App\Services\RoomService;

class SiteArticleController extends Controller
{
    private $article;
    private $category;
    private $room;
    public function __construct(ArticleService $article, CategoryService $category, RoomService $room)
    {
        $this->article = $article;
        $this->category = $category;
        $this->room = $room;
    }

    public function index(Request $request, $id, $slug){
        $category = $this->category->getById($id);
        $params['category_id'] = $id;
        $params['limit'] = 10;
        $params['sortBy'] = 'id';
        if($category->type >= 1 && $category->type <= 5){
            $article = $this->article->search($params);
            return view('site.article.index')->with('article', $article)->with('category', $category);
        }
        if($category->type == 6){
            $room = $this->room->search($params);
            return view('site.room.index')->with('room', $room)->with('category', $category);
        }
        abort(404);
    }

    public function detail(Request $request, $id, $slug){
        $article = $this->article->getById($id);
        $relate = $this->article->getRelate($article->category->id, $id, 5);
        return view('site.article.detail')->with('article', $article)->with('relate', $relate);
    }

    public function detailRoom(Request $request, $id, $slug){
        $room = $this->room->getById($id);
        $relate = $this->room->getRelate($room->category->id, $id, 5);
        return view('site.room.detail')->with('room', $room)->with('relate', $relate);
    }
}
