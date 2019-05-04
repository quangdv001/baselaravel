@if($item) 
    <div class="news-post line-bottom list-style-post small-post">
        <div class="news-post-content">
        <div class="post-title title">
            <i class="list-icon fas fa-circle"></i>
            <a class="news-post-link" href="/posts/{{ $item->slug}}">{{ $item->title }}</a></div>
        </div>
    </div>
@endif