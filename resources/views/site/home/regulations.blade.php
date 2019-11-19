@extends('site.layout.main')
@section('title')
@lang('header.regulations')
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>@lang('header.regulations')</span>
        </div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a
                            href="{{ route('site.home.index' )}}" title="Trang chủ">Trang chủ</a></li>
                    <li class="breadcrumb-item active"><span>@lang('header.regulations')</span></li>
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
                            <h1 class="page-title"><a href="#">@lang('header.regulations')</a></h1>
                            <div class="col">
                                <div class="list-post row">
                                    <div class="news-post line-bottom download-item">
                                        @if(sizeof($files) > 0)
                                            @foreach($files as $file) 
                                            
                                            <div class="news-post-content">
                                                <h2 class="post-title title"><i class="icon-download fa fa-file-pdf"
                                                        aria-hidden="true"></i><a href="{{ route('site.home.downloadFile', $file->file_id)  }}">{{ $file->name }}</a></h2>
                                                <div class="post-meta-container">
                                                    <div class="span post-meta-item"><i class="far fa-clock"></i>
                                                        {{ $file->created_at->format('d/m/Y') }}</div>
                                                </div><a class="download-icon pull-right"
                                                    href="{{ route('site.home.downloadFile', $file->file_id)  }}"><i
                                                        class="fa fa-download" aria-hidden="true"></i><span>Tải
                                                        file</span></a>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <nav aria-label="Page navigation">
                      <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
                      </ul>
                    </nav> -->
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
