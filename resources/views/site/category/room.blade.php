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
                @if(sizeof($data) > 0)
                <div class="list-post">
                    @foreach($data as $v)
                    <div class="forrent-post line-bottom">
                        <div class="post-content"><a class="news-post-image-link" href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">
                                <figure class="image-container">
                                    <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                class="fa fa-camera"></i></span></div><img class="img-responsive"
                                        src="{{ $v->img }}" alt="title alt" />
                                </figure>
                            </a>
                            <h3 class="post-title title"><a class="news-post-link" href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">{{ $v->title }}</a></h3>
                            <div class="row">
                                <div class="col rent-attribute"><strong>Giá :</strong><span> {{ number_format($v->price, 0,",",".") }} triệu</span></div>
                                <div class="col rent-attribute"><strong>Diện tích :</strong><span> {{ number_format($v->acreage, 0,",",".") }} m²</span></div>
                                <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> {{ isset($arrDistrict[$v->district_id]) ? $arrDistrict[$v->district_id] : '--'  }}</span>
                                </div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i>
                                {{ $v->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a
                                        href="#admin"> {{ $v->user_name_c != '' ? $v->user_name_c : $v->admin_name_c }}</a></span></div>
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
