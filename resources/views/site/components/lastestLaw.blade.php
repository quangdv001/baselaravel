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
                            <div class="short-description">{!! $item->short_description !!}</div>
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


    {{-- <div class="row">                      
        <div class="slide-owl-carousel owl-carousel owl-theme"><a class="block" href="#item">
            <div class="cover-item">
              <div class="landscape_image"><img src="./assets/images/slide_01.jpg" alt="Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
            </div>
            <div class="detail-item">
              <div class="title">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</div>
              <div class="meta-info"><span class="meta-info-item">Tin tức</span><span class="meta-info-item"><i class="far fa-clock"></i> Th3-27/10/2015</span></div>
              <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không chỉ do tình trạng sốt đất dẫn đến giá ảo.</div>
            </div></a><a class="block" href="#item">
            <div class="cover-item">
              <div class="landscape_image"><img src="./assets/images/slide_01.jpg" alt="Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
            </div>
            <div class="detail-item">
              <div class="title">Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</div>
              <div class="meta-info"><span class="meta-info-item">Tin tức</span><span class="meta-info-item"><i class="far fa-clock"></i> Th3-27/10/2015</span></div>
              <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không chỉ do tình trạng sốt đất dẫn đến giá ảo.</div>
            </div></a><a class="block" href="#item">
            <div class="cover-item">
              <div class="landscape_image"><img src="./assets/images/slide_01.jpg" alt="Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp"/></div>
            </div>
            <div class="detail-item">
              <div class="title">Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</div>
              <div class="meta-info"><span class="meta-info-item">Tin tức</span><span class="meta-info-item"><i class="far fa-clock"></i> Th3-27/10/2015</span></div>
              <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không chỉ do tình trạng sốt đất dẫn đến giá ảo.</div>
            </div></a>
        </div>
    </div>
    <div class="row">
      <ul class="list-head">
        <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i> Th3-27/10/2015</span></li>
        <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i> Th3-27/10/2015</span></li>
        <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i> Th3-27/10/2015</span></li>
        <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i> Th3-27/10/2015</span></li>
      </ul>
    </div> --}}