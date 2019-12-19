<?php

namespace App\Widgets;

use App\Services\CategoryService;
use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Str;
class Header extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(CategoryService $categoryService)
    {
        $categories = $categoryService->getAll();

        $html = $this->showCategories($categories, 0, '');
        return view('widgets.header', [
            'config' => $this->config,
            'htmlCategory' => $html
        ]);
    }

    private function showCategories($categories, $parent_id = 0, $char = '')
    {
        $html = '';
        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
        if ($cate_child)
        {
            $html .= '<ul>';
            foreach ($cate_child as $key => $item)
            {
                $link = $item->url;

                if($item->type >=1 && $item->type <= 6){
                    $link = route('site.article.index', ['slug' => Str::slug($item->name, '-'), 'id' => $item->id]);
                } elseif($item->type == 7){
                    $link = route('site.page.index', ['slug' => $item->page->slug]);
                }
                // Hiển thị tiêu đề chuyên mục
//                $html .= '<li>'. '<a href="'. $link .'">' . $item['name'] . '</a>';

                if ($item['url'] == '/') {
                    $html .= '<li>'. '<a href="'. $link .'"><i class="fa fa-home"></i></a>';
                } else {
                    $html .= '<li>'. '<a href="'. $link .'">' . $item['name'] . '</a>';
                }


                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $html .= $this->showCategories($categories, $item->id, $char.'');
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        else {
            if($parent_id == 0){
                $html .= '<ul>';
                $html .= '</ul>';
            }
        }
        return $html;
    }
}
