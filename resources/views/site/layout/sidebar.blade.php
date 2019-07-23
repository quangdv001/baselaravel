<div class="col-sm-3 sidebar">
    <div class="list-post-aside">
        <h3 class="module-title solid-color"><a href="#">Danh mục</a></h3>
        <ul class="list-categories">
            <li><a href="{{ route('site.home.gastation' )}}"><i class="material-icons list-style">chevron_right</i>Điểm
                    bán vé</a></li>
            <li><a href="{{ route('site.home.ticketLocation' )}}"><i
                        class="material-icons list-style">chevron_right</i>Đại lý bán vé</a></li>
            <li><a href="#"><i class="material-icons list-style">chevron_right</i>Hủy chuyến</a></li>
            <li><a href="#"><i class="material-icons list-style">chevron_right</i>Gửi hành lý</a></li>
            <li><a href="#"><i class="material-icons list-style">chevron_right</i>Ký gửi</a></li>
        </ul>
    </div>

    @if(sizeof($special_article) > 0)
    <div class="list-post-aside">
        <h3 class="module-title solid-color"><a href="#">@lang('booking.article')</a></h3>
        @foreach($special_article as $v)
            @if($v->title)
            <div class="news-post line-bottom small-post"><a class="news-post-image-link" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">
                    <figure class="image-container rectangle-image">
                        <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                    class="fa fa-camera"></i></span></div><img class="img-responsive"
                            src="{{ $v->img }}" alt="title alt" />
                    </figure>
                </a>
                <div class="news-post-content">
                    <h3 class="post-title title"><a class="news-post-link" 
                            href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></h3>
                    <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i>
                            {{ $v->created_at->format('d/m/Y') }}</span></div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @endif


    <div class="list-post-aside">
        <h3 class="module-title solid-color"><a href="#">Liên kết website</a></h3>
        <ul class="list-categories">
            <li><a href="https://vinacomin.vn"><i class="material-icons list-style">chevron_right</i>Tập Đoàn CN Than -
                    KSản VN</a></li>
            <li><a href="https://ratraco.vn/"><i class="material-icons list-style">chevron_right</i>CTy CP Vận Tải & TM
                    RATRACO</a></li>
        </ul>
    </div><a class="banner-add" href="#banner"><img
            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bd33c405c632.jpg" alt="banner title" /></a><a
        class="banner-add" href="#banner"><img src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bb48fba328c6.jpg"
            alt="banner title" /></a>
</div>
