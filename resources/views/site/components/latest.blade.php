@if ($news && count($news) > 0)
<h3 class="module-title"><a href="#">{!! $moduleTitle !!}</a></h3>
    @foreach ($latestNews as $key=>$item)
        <div class="news-post line-bottom list-style-post small-post">
            <div class="news-post-content">
            <div class="post-title title">
                <i class="list-icon fas fa-circle"></i>
                <a class="news-post-link" href="/posts/{{ $item->slug}}">{{ $item->title }}</a></div>
            </div>
        </div>
    @endforeach
@else
    <h3 class="module-title"><a href="#">{!! $moduleTitle !!}</a></h3>
    <div class="content">Không có bài viết</div>
@endif