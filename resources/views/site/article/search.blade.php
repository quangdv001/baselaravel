@extends('site.layout.main')
@section('title')
Tìm kiếm
@endsection
@section('class_page')
category
@endsection
@section('content')
<div class="main">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index') }}"
                            title="Trang chủ">Trang chủ</a></li>
                    {{-- <li class="breadcrumb-item"><a href="#sublink" title="Title link">Sub page</a></li> --}}
                    <li class="breadcrumb-item active"><span>Tìm kiếm</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container main-wrapper">
            <h1 class="page-title"><a href="#">{{ $title }} </a></h1>
            <div class="row">
                <div class="col-sm-9 border-sm-right">
                    {{-- <div class="row main-head">
                        <div class="col-sm-9 border-sm-right">
                            <div class="row">
                                <div class="slide-owl-carousel owl-carousel owl-theme"><a class="block" href="#item">
                                        <div class="cover-item">
                                            <div class="landscape_image"><img src="./assets/images/slide_01.jpg"
                                                    alt="Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp" />
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="title">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm
                                                kế tiếp</div>
                                            <div class="meta-info"><span class="meta-info-item">Tin tức</span><span
                                                    class="meta-info-item"><i class="far fa-clock"></i>
                                                    Th3-27/10/2015</span></div>
                                            <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không
                                                chỉ do tình trạng sốt đất dẫn đến giá ảo.</div>
                                        </div>
                                    </a><a class="block" href="#item">
                                        <div class="cover-item">
                                            <div class="landscape_image"><img src="./assets/images/slide_01.jpg"
                                                    alt="Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp" />
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="title">Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào
                                                năm kế tiếp</div>
                                            <div class="meta-info"><span class="meta-info-item">Tin tức</span><span
                                                    class="meta-info-item"><i class="far fa-clock"></i>
                                                    Th3-27/10/2015</span></div>
                                            <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không
                                                chỉ do tình trạng sốt đất dẫn đến giá ảo.</div>
                                        </div>
                                    </a><a class="block" href="#item">
                                        <div class="cover-item">
                                            <div class="landscape_image"><img src="./assets/images/slide_01.jpg"
                                                    alt="Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp" />
                                            </div>
                                        </div>
                                        <div class="detail-item">
                                            <div class="title">Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào
                                                năm kế tiếp</div>
                                            <div class="meta-info"><span class="meta-info-item">Tin tức</span><span
                                                    class="meta-info-item"><i class="far fa-clock"></i>
                                                    Th3-27/10/2015</span></div>
                                            <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không
                                                chỉ do tình trạng sốt đất dẫn đến giá ảo.</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <ul class="list-head">
                                    <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào
                                            năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                            Th3-27/10/2015</span></li>
                                    <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào
                                            năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                            Th3-27/10/2015</span></li>
                                    <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào
                                            năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                            Th3-27/10/2015</span></li>
                                    <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào
                                            năm kế tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                            Th3-27/10/2015</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="block-title underline">
                                <h2 class="title solid-color text-uppercase"><span>Tư vấn luật</span></h2>
                            </div>
                            <div class="row">
                                <ul class="list-head">
                                    <li><a class="title" href="#"><span><i
                                                    class="far fa-clock"></i></span><span>&nbsp;Thị trường BĐS chạm đỉnh
                                                2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                    <li><a class="title" href="#"><span><i
                                                    class="far fa-clock"></i></span><span>&nbsp;Thị trường BĐS chạm đỉnh
                                                2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                    <li><a class="title" href="#"><span><i
                                                    class="far fa-clock"></i></span><span>&nbsp;Thị trường BĐS chạm đỉnh
                                                2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                    <li><a class="title" href="#"><span><i
                                                    class="far fa-clock"></i></span><span>&nbsp;Thị trường BĐS chạm đỉnh
                                                2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    @if(sizeof($article) > 0) 

                    <div class="list-post">
                        @foreach($article as $v)
                        <div class="news-post line-bottom"><a class="news-post-image-link" href="{{ route('site.article.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">
                                <figure class="image-container">
                                    <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                class="fa fa-camera"></i></span></div><img class="img-responsive"
                                        src="{{ $v->img }}"
                                        alt="title alt" />
                                </figure>
                            </a>
                            <div class="news-post-content">
                                <h2 class="post-title title"><a class="news-post-link" href="{{ route('site.article.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">{{ $v->title }}</a></h2>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            {{ $v->user_name_c ? $v->user_name_c : $v->admin_name_c }}</a></span></div>
                                <p class="post-desc">{!! $v->short_description !!}
                                </p><span class="read-more-button"><a href="{{ route('site.article.detail', ['slug' => Str::slug($v->title, '-'), 'id' => $v->id]) }}">Xem tiếp...</a></span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    {{ $article->links() }}
                    {{-- <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                        </ul>
                    </nav> --}}
                </div>
                <div class="col-sm-3 sidebar">
                    @widget('recent_news')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')

@endsection
