@extends('site.layouts.main')
@section('content')
<div class="section-main">
  <div class="container main-wrapper">      
    <div class="row">
      <div class="col-sm-9 border-sm-right">
        <div class="row main-head">
          <div class="col-sm-3 border-sm-right">
            @include('site.components.lastestLand')
          </div>
          <div class="col-sm-9">
            @include('site.components.lastestLaw')
          </div>
        </div>
        <div class="row">
          <div class="col-sm-8 border-sm-right">
            <div class="block">
              <div class="heading-block">
                <div class="block-title underline">
                  <h2 class="title solid-color text-uppercase"><span>Tin cho thuê</span></h2>
                </div>
                <div class="pull-right" style="padding-top:6px;">
                  <a href="{{ route('site.home.usercreate') }}" class="btn btn-raised btn-primary btn-sm">Đăng tin</a>
                </div>
              </div> <!-- / .heading-block -->
              <div class="list-post">
                  @if (count($latestRoom) > 0)
                      @foreach ($latestRoom as $item)
                          @include('site.elements.forRentListItem', ['item'=>$item, 'districts'=>$districts])                            
                      @endforeach
                  @else
                      <p style="padding: 15px;">Không có nội dung</p>
                  @endif
              </div>
            </div>
            @include('site.home.mainFooter')
          </div>
          <div class="col-sm-4">
            @include('site.components.latestBlock', ['moduleTitle'=>'Đô Thị', 'type'=>'thumb', 'news'=>$latestProjects])
          </div>
        </div>
      </div>
      <div class="col-sm-3 sidebar">
        @include('site.layouts.sidebar')
      </div> <!-- sidebar -->
    </div>
  </div>
</div>
@endsection