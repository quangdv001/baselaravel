@if (count($lastestLaws) > 0)
    <div class="row">                      
        <div class="slide-owl-carousel owl-carousel owl-theme"> 
                  
            @foreach ($lastestLaws as $key=>$item)
                @if ($key <= 2)
                    <a class="block" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">
                        <div class="cover-item">
                            <div class="landscape_image"><img src="{{ $item->img}}" alt="Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
                        </div>
                        <div class="detail-item">
                        <div class="title">{{ $item->title }}</div>
                            <div class="meta-info"><span class="meta-info-item"><i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}</span></div>
                            <div class="short-description">@if (strlen($item->short_description) > 50) {!! mb_substr($item->short_description, 0, mb_strpos($item->short_description, ' ', 50)) !!}... @else {!! $item->short_description !!} @endif</div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <ul class="list-head">
            @foreach ($lastestLaws as $key=>$item)
                @if ($key > 2)
                    <li><a class="title" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">{{ $item->title }}</a><span class="meta-info-item"> <i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}</span></li>
                @endif
            @endforeach
        </ul>
    </div>
@else
    <h3 class="module-title"><a href="#">Tin Heading</a></h3>
    <div class="content">Không có bài viết</div>
@endif