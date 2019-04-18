<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Support\Facades\View;
use App\Services\ArticleService;

class SiteHomeController extends Controller
{
    private $category;
    private $article;
    public function __construct(CategoryService $category, ArticleService $article){
        $this->category = $category;
        $this->article = $article;
        $categories = $this->category->getAll();
        // $htmlCategory = $this->category->genMenu($categories);
        // View::share('categories', $htmlCategory);
    }

    public function index(){
        // $article = $this->article->getAll();
        // $room = $this->room->getAll();
        // $project = $this->project->getAll();
        return view('welcome');
    }
}
