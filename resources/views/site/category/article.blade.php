@extends('site.layouts.main')
@section('content')
{{-- @include('site.elements.breadCrumb') --}}
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index') }}"
                        title="Trang chủ">Trang chủ</a></li>
                {{-- <li class="breadcrumb-item"><a href="#sublink" title="Title link">Sub page</a></li> --}}
                <li class="breadcrumb-item active"><span>{{ $category->name }}</span></li>
            </ol>
        </div>
    </div>
</div>
<div class="section-main">
    <div class="container main-wrapper">
        <h1 class="page-title"><a href="#">{{ $category->name }}</a></h1>
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
                                        <div class="title">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế
                                            tiếp</div>
                                        <div class="meta-info"><span class="meta-info-item">Tin tức</span><span
                                                class="meta-info-item"><i class="far fa-clock"></i>
                                                Th3-27/10/2015</span></div>
                                        <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không chỉ do
                                            tình trạng sốt đất dẫn đến giá ảo.</div>
                                    </div>
                                </a><a class="block" href="#item">
                                    <div class="cover-item">
                                        <div class="landscape_image"><img src="./assets/images/slide_01.jpg"
                                                alt="Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp" />
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="title">Tin 2 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm
                                            kế tiếp</div>
                                        <div class="meta-info"><span class="meta-info-item">Tin tức</span><span
                                                class="meta-info-item"><i class="far fa-clock"></i>
                                                Th3-27/10/2015</span></div>
                                        <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không chỉ do
                                            tình trạng sốt đất dẫn đến giá ảo.</div>
                                    </div>
                                </a><a class="block" href="#item">
                                    <div class="cover-item">
                                        <div class="landscape_image"><img src="./assets/images/slide_01.jpg"
                                                alt="Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp" />
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="title">Tin 3 Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm
                                            kế tiếp</div>
                                        <div class="meta-info"><span class="meta-info-item">Tin tức</span><span
                                                class="meta-info-item"><i class="far fa-clock"></i>
                                                Th3-27/10/2015</span></div>
                                        <div class="short-description">Cột giá nhà phố tăng cao ngất ngưỡng không chỉ do
                                            tình trạng sốt đất dẫn đến giá ảo.</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <ul class="list-head">
                                <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế
                                        tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                        Th3-27/10/2015</span></li>
                                <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế
                                        tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                        Th3-27/10/2015</span></li>
                                <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế
                                        tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
                                        Th3-27/10/2015</span></li>
                                <li><a class="title" href="#">Thị trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế
                                        tiếp</a><span class="meta-info-item"> <i class="far fa-clock"></i>
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
                                <li><a class="title" href="#"><span><i class="far fa-clock"></i></span><span>&nbsp;Thị
                                            trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                <li><a class="title" href="#"><span><i class="far fa-clock"></i></span><span>&nbsp;Thị
                                            trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                <li><a class="title" href="#"><span><i class="far fa-clock"></i></span><span>&nbsp;Thị
                                            trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                                <li><a class="title" href="#"><span><i class="far fa-clock"></i></span><span>&nbsp;Thị
                                            trường BĐS chạm đỉnh 2019 và rơi vào thoái trào năm kế tiếp</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
                @if(sizeof($data) > 0)
                <div class="list-post">
                    @foreach($data as $v)
                    <div class="news-post line-bottom"><a class="news-post-image-link"
                            href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">
                            <figure class="image-container">
                                <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                            class="fa fa-camera"></i></span></div><img class="img-responsive"
                                    src="{{ $v->img }}" alt="title alt" />
                            </figure>
                        </a>
                        <div class="news-post-content">
                            <h2 class="post-title title"><a class="news-post-link"
                                    href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">{{ $v->title }}</a>
                            </h2>
                            <div class="post-meta-container"><span class="post-meta-item"><i
                                        class="far fa-clock"></i>{{ $v->created_at->format('d/m/Y') }}
                                </span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#">
                                        {{ $v->user_name_c != '' ? $v->user_name_c : $v->admin_name_c }}</a></span>
                            </div>
                            <p class="post-desc">{!! $v->short_description !!}
                            </p><span class="read-more-button"><a
                                    href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">Xem
                                    tiếp...</a></span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <nav aria-label="Page navigation">
                    {{ $data->links() }}
                </nav>
                @else
                <div class="text-left" style="padding: 15px;">
                    Rất tiếc nội dung bạn đang tìm kiếm không tồn tại hoặc bạn không có đủ quyền.
                </div>
                @endif

            </div>
            <div class="col-sm-3 sidebar">
                @include('site.layouts.sidebar')
            </div> <!-- sidebar -->
        </div>
    </div>
</div>

@endsection
