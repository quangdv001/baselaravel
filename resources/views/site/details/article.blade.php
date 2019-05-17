@extends('site.layouts.main')
@section('content')
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index') }}"
                        title="Trang chủ">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('site.home.category', $category->slug) }}" title="Title link">{{ $category->name }}</a></li>
                <li class="breadcrumb-item active"><span>{{ $data->title }}</span></li>
            </ol>
        </div>
    </div>
</div>
<div class="section-main">
    <div class="container main-wrapper">
        <h1 class="page-title"><a href="#">{{ $data->title }}</a></h1>
        <div class="row">
            <div class="col-sm-9 border-sm-right">
                <div class="detail-post">
                    <div class="news-post">
                        <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i>
                            {{ $data->created_at->format('d/m/Y') }}</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a
                                    href="#admin"> {{ $data->user_name_c != '' ? $data->user_name_c : $data->admin_name_c }}</a></span></div>
                        <div class="post-sapo">{!! $data->short_description !!}</div>
                        <div class="news-post-content">
                            {!! $data->description !!}
                            <div class="pull-right"><strong>{{ $data->user_name_c != '' ? $data->user_name_c : $data->admin_name_c }}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="list-post-aside"></div>
                @if(sizeof($relate) > 0)
                <h3 class="module-title"><a href="#">Tin Liên quan</a></h3>
                @foreach($relate as $v)
                <div class="news-post line-bottom list-style-post small-post">
                    <div class="news-post-content">
                        <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link"
                        href="{{ route('site.home.showDetail',['slugCategory' => $category->slug, 'slugDetail' => $v->slug]) }}">{{ $v->title }}</a></div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="col-sm-3 sidebar">
                @include('site.layouts.sidebar')
            </div> <!-- sidebar -->
        </div>
    </div>
</div>

@endsection
