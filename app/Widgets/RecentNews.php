<?php

namespace App\Widgets;

use App\Services\ArticleService;
use Arrilot\Widgets\AbstractWidget;

class RecentNews extends AbstractWidget
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
    public function run(ArticleService $article)
    {
        $params['type'] = 4;
        $params['limit'] = 6;
        $params['sortBy'] = 'id';
        $articles = $article->search($params);
        return view('widgets.recent_news', [
            'config' => $this->config,
            'articles' => $articles,
        ]);
    }
}
