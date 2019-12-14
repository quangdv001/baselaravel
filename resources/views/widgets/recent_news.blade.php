<div class="list-post-aside sticky-top" style="top: 60px;">
    @if(sizeof($articles) > 0)
    <h3 class="module-title"><a href="#">Tin mới nhất</a></h3>
    @foreach($articles as $v)
    <div class="news-post line-bottom  small-post"><a class="news-post-image-link"
            href="{{ route('site.article.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">
            <figure class="image-container">
                <div class="featured-image-overlay"><span class="featured-image-icon"><i
                            class="fa fa-camera"></i></span></div><img class="img-responsive" src="{{ $v->img }}"
                    alt="title alt" />
            </figure>
        </a>
        <div class="news-post-content">
            <h3 class="post-title title"><a class="news-post-link"
                    href="{{ route('site.article.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">{{ $v->title }}</a>
            </h3>
            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i>
                    {{ $v->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i
                        class="fa fa-user-check"></i><a href="#admin">
                        {{ $v->user_name_c ? $v->user_name_c : $v->admin_name_c }}</a></span></div>
        </div>
    </div>
    @endforeach

    @endif

    {{-- <a href="#">
        <div class="row"><img src="https://file4.batdongsan.com.vn/2019/03/12/RUFz0fap/20190312163851-0eab.jpg" alt=""
                width="100%" height="369px" /></div>
    </a><a href="#">
        <div class="row"><img src="https://file4.batdongsan.com.vn/2019/03/12/RUFz0fap/20190312163851-0eab.jpg" alt=""
                width="100%" height="369px" /></div>
    </a><a href="#">
        <div class="row"><img src="https://file4.batdongsan.com.vn/2019/03/12/RUFz0fap/20190312163851-0eab.jpg" alt=""
                width="100%" height="369px" /></div>
    </a><a href="#">
        <div class="row"><img src="https://file4.batdongsan.com.vn/2019/03/12/RUFz0fap/20190312163851-0eab.jpg" alt=""
                width="100%" height="369px" /></div>
    </a><a href="#">
        <div class="row"><img src="https://file4.batdongsan.com.vn/2019/03/12/RUFz0fap/20190312163851-0eab.jpg" alt=""
                width="100%" height="369px" /></div>
    </a> --}}
</div>
