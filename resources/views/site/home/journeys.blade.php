@extends('site.layout.main')
@section('title')
@lang('home.journeys_fare')
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>@lang('home.journeys_fare')</span></div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a
                            href="{{ route('site.home.index' )}}" title="Trang chủ">@lang('home.journeys_fare')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('home.journeys_fare')</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9">
                    <div class="row">
                        <div class="col">
                            <div class="detail-post">
                                <h1 class="page-title"><a href="#">@lang('home.livitrans_company')</a>
                                </h1>
                                <div class="news-post">
                                    @if(!isset($article['content']))
                                        <div> Không có nội dung</div>
                                    @endif
                                    {!! $article['content'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('site.layout.sidebar')
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
@endsection
