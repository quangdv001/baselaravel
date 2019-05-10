
<div class="detail-post">
    <div class="news-post">
        <div class="post-meta-container">
            <span class="post-meta-item"><i class="far fa-clock"></i> {{$post->created_at->diffForHumans() }}</span>
            <span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $post->admin_name_c }}</a></span>
        </div>

    <div class="post-sapo">{!! $post->short_description !!}</div>
        <div class="news-post-content">
            {!! $post->description !!}
        </div>
    </div>
</div>
