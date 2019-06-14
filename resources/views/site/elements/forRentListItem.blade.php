@if($item) 
    <div class="forrent-post line-bottom">
        <div class="post-content"><a class="news-post-image-link" href="{{ route('site.home.showDetail',['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">
            @if ($item->img)
                <figure class="image-container">
                    <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $item->img }}" alt="title alt"/>
                </figure></a>
            @endif
            <h3 class="post-title title"><a class="news-post-link" href="{{ route('site.home.showDetail',['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}">{{ $item->title }}</a></h3>
            <div class="row">
            <div class="col rent-attribute"><strong>Giá :</strong><span> {{ $item->price }} triệu</span></div>
            <div class="col rent-attribute"><strong>Diện tích :</strong><span> {{ $item->acreage }} m²</span></div>
            <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> {{ $districts[$item->district_id] }}</span></div>
            </div>
            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> {{ $item->admin_name_c }}</a></span></div>
        </div>
    </div>
@endif