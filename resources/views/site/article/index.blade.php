@extends('site.layout.main')
@section('title')
{{ $cate->name }}
@endsection
@section('content')
<div class="section-dark"
    style="background: #ccc url({{ asset('public/assets/site/themes/assets/images/slide-bg.png') }}) center top /auto 100%;margin-bottom: 15px;">
    <div class="container">
        <div class="row align-items-center cover-slide justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="block-title">
                        <h2 class="title sevices-title-nomarl"><span>KHÔNG GIAN SỐNG LÀ ĐẦU TƯ NỀN TẢNG</span></h2>
                    </div>
                    <div class="sevices-title-large">CHO NHỮNG THÀNH CÔNG NỐI TIẾP VỀ SAU</div>
                </div>
                @if(sizeof($category) > 0)
                <div class="row services-blog">
                    @foreach($category as $v)
                    @if($v->type == 0)
                    <div class="col-12 col-sm-3">
                        <a class="block service-blog text-center @if($cate->id == $v->id) active @endif" href="{{ strval($v->url) != '' ? url(strval($v->url)) : '#' }}">
                            <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                            </div>
                            <div class="title">
                              <h3><span>{{ $v->name }}</span></h3>
                            </div></a>
                        </div>
                    @elseif($v->type == 1)
                    <div class="col-12 col-sm-3">
                            <a class="block service-blog text-center @if($cate->id == $v->id) active @endif" href="{{ route('site.article.index',['id' => $v->id, 'slug' => $v->slug]) }}">
                                <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                                </div>
                                <div class="title">
                                  <h3><span>{{ $v->name }}</span></h3>
                                </div></a>
                            </div>
                    @elseif($v->type == 2)
                    <div class="col-12 col-sm-3">
                            <a class="block service-blog text-center @if($cate->id == $v->id) active @endif" href="{{ route('site.product.list',['id' => $v->id, 'slug' => $v->slug]) }}">
                                <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                                </div>
                                <div class="title">
                                  <h3><span>{{ $v->name }}</span></h3>
                                </div></a>
                            </div>
                    @elseif($v->type == 3)
                    <div class="col-12 col-sm-3">
                            <a class="block service-blog text-center @if($cate->id == $v->id) active @endif" href="{{ route('site.article.list',['id' => $v->id, 'slug' => $v->slug]) }}">
                                <div class="cover-icon"><img src="{{ $v->img }}" alt=""/>
                                </div>
                                <div class="title">
                                  <h3><span>{{ $v->name }}</span></h3>
                                </div></a>
                            </div>
                    @endif

                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="section section-subpage">
      <div class="container">
        <div class="text-center">
          <div class="block-title underline">
            <h1 class="title solid-color text-uppercase"><span>{{ $cate->name }}</span></h1>
          </div>
        </div>
        @if(sizeof($data) > 0)
        <div class="row">
            @foreach($data as $v)
            
            <div class="col-md-4">
              <div class="block block-media-top">
                <div class="row">
                <div class="col-12"><a class="cover-image landscape_image" href="{{ route('site.article.detail',['id' => $v->id, 'slug' => $v->slug]) }}"><img src="{{ $v->img }}" alt="{{ $v->title }}"></a></div>
                  <div class="col-12 text-left block-content">
                    <h3><a class="title" href="{{ route('site.article.detail',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a></h3>
                    <div class="desciption">{!! str_limit($v->short_description, 100) !!}</div><a class="readmore button-border" href="{{ route('site.article.detail',['id' => $v->id, 'slug' => $v->slug]) }}">Xem chi tiết <i class="readmore-icon material-icons">arrow_forward</i></a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <nav aria-label="Page navigation">
            <div class="d-flex justify-content-center">
                {{ $data->links() }}
            </div>
          {{-- <ul class="pagination justify-content-center">
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
@endsection
@section('custom_js')
@endsection
