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
                            <div class="short-description">@if (strlen(strip_tags($item->short_description)) > 100) {!! mb_substr(strip_tags($item->short_description), 0, mb_strpos(strip_tags($item->short_description), ' ', 100)) !!}... @else {!! $item->short_description !!} @endif</div>
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
                    <li><a class="title" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">@if (strlen(strip_tags($item->title)) > 100) {!! mb_substr(strip_tags($item->title), 0, mb_strpos(strip_tags($item->title), ' ', 100)) !!}... @else {!! $item->title !!} @endif</a><span class="meta-info-item"> <i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}</span></li>
                @endif
            @endforeach
        </ul>
    </div>
@else
    <h3 class="module-title"><a href="#">Tin Heading</a></h3>
    <div class="content">Không có bài viết</div>
@endif