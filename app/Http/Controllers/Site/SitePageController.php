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

    public function index(Request $request, $slug){
        $page = $this->page->first(['slug' => $slug]);
        return view('site.page.index')->with('page', $page);
    }
}
