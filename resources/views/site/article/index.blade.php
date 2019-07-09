@extends('site.layout.main')
@section('title')
{{ $cate->name }}
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>{{ $cate->name }}</span>
        </div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a href="index.html"
                            title="Trang chủ">@lang('header.home')</a></li>
                    {{-- <li class="breadcrumb-item"><a href="#sublink" title="Title link">Sub page</a></li> --}}
                    <li class="breadcrumb-item active"><span>{{ $cate->name }}</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9 border-sm-right">
                    <div class="row">
                        <div class="col">
                            <h1 class="page-title"><a href="#">{{ $cate->name }}</a></h1>
                            @if(sizeof($data) > 0)
                            <div class="col">
                                <div class="list-post row">
                                    @foreach($data as $v)
                                    @if($v->title)
                                    <div class="news-post line-bottom"><a class="news-post-image-link"
                                            href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">
                                            <figure class="image-container rectangle-image">
                                                <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                            class="fa fa-camera"></i></span></div><img
                                                    class="img-responsive"
                                                    src="{{ $v->img }}"
                                                    alt="title alt" />
                                            </figure>
                                        </a>
                                        <div class="news-post-content">
                                            <h2 class="post-title title"><a class="news-post-link"
                                            href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></h2>
                                            <div class="post-meta-container"><span class="post-meta-item"><i
                                                        class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span
                                                    class="post-meta-item"><i class="fa fa-user-check"></i><a
                                                        href="#admin"> Admin</a></span></div>
                                            <p class="post-desc">{!! $v->short_description !!}
                                            </p><a class="read-more-button" href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">Xem tiếp...</a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <nav aria-label="Page navigation">
                                {{ $data->links() }}
                                {{-- <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                                </ul> --}}
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 sidebar">
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Danh mục</a></h3>
                        <ul class="list-categories">
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Đặt vé</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Du lịch</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Hủy chuyến</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Gửi hành lý</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Ký gửi</a></li>
                        </ul>
                    </div>
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Tin nổi bật</a></h3>
                        <div class="news-post line-bottom small-post"><a class="news-post-image-link"
                                href="./single.html">
                                <figure class="image-container rectangle-image">
                                    <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                class="fa fa-camera"></i></span></div><img class="img-responsive"
                                        src="https://bit.ly/2ESxuyd" alt="title alt" />
                                </figure>
                            </a>
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        <div class="news-post line-bottom small-post">
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link" href="./single.html">Lorem Ipsum
                                        là gì, Tại sao lại sử dụng nó?</a></h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> Th3-27/10/2015</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                    </div><a class="banner-add" href="#banner"><img
                            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bd33c405c632.jpg"
                            alt="banner title" /></a><a class="banner-add" href="#banner"><img
                            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bb48fba328c6.jpg"
                            alt="banner title" /></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
@endsection
