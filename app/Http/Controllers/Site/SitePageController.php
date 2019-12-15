<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PageService;

class SitePageController extends Controller
{
    private $page;
    public function __construct(PageService $page)
    {
        $this->page = $page;
    }

    public function index(Request $request, $id, $slug){
        $page = $this->page->getById($id);
        return view('site.page.index')->with('page', $page);
    }
}
