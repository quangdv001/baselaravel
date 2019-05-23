@if (count($latestNews) > 0)
<?php
//   dd($categories);
?>
    <h3 class="module-title"><a href="#">Tin mới nhất</a></h3>
    @foreach ($latestNews as $key=>$item)
        @if ($key === 0)
            <div class="news-post line-bottom  small-post"><a class="news-post-image-link" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">
                <figure class="image-container">
                    <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $item->img }}" alt="title alt"/>
                </figure></a>
                <div class="news-post-content">
                    <h3 class="post-title title"><a class="news-post-link" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">{{ $item->title }}</a></h3>
                    <div class="post-meta-container">
                        <span class="post-meta-item"><i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}</span>
                    <span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $item->admin_name_c }}</a></span></div>
                </div>
            </div>
        @else
            <div class="news-post line-bottom list-style-post small-post">
                <div class="news-post-content">
                <div class="post-title title">
                    <i class="list-icon fas fa-circle"></i>
                    <a class="news-post-link" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">{{ $item->title }}</a></div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <h3 class="module-title"><a href="#">Tin mới nhất</a></h3>
    <div class="content">Không có bài viết</div>
@endif