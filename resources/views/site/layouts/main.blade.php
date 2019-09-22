<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap fonts and icons-->
    @include('site.layouts.css')
    @yield('stylesheets')
  </head>
  <body>       
    <div class="page home">
      {{-- HEADER --}}
      @include('site.layouts.header')
      {{-- END HEADER --}}
      <div class="main">
        @yield('content')
      {{-- PARTNERS --}}
      @include('site.layouts.partners', ['categoryExchange'=>$categoryExchange, 'exchangePartnerAdvertise' => $exchangePartnerAdvertise])
      {{-- END PARTNERS --}}
      <!-- FOOTER BANNER ADD -->
      @if (isset($horizontalAdvertise) && count($horizontalAdvertise) > 0)
      <div class="section-gap">
        <div class="container">
          <div class="fullads-carousel owl-carousel owl-theme">
            @foreach ($horizontalAdvertise as $item)
    
            <a class="item" target="_blank" href="@if (isset($item['url'])){{ $item['url'] }} @else # @endif"><img src="{{ $item['img'] }}" alt=""  style="width:100%; max-width:100%; max-height: 120px" class="mx-auto d-block" srcset=""></a>
        
            @endforeach</div> <!-- /.ads-carousel -->
        </div>
      </div>
      @endif
      </div>
      {{-- FOOTER --}}
      @include('site.layouts.footer')
      {{-- END FOOTER --}}
    </div>
    @include('site.layouts.js')
    <input type="hidden" class="success_message" value="{{ session()->has('success_message') ? session('success_message') : '' }}">
    <input type="hidden" class="error_message" value="{{ session()->has('error_message') ? session('error_message') : '' }}">
    <script>
    $(function () {
        $(".fullads-carousel").owlCarousel({
          loop: true,
          dots: false,
          autoplay: true,
          nav: true,
          navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
          margin: 20,
          autoplayTimeout: 3000,
          responsive: {
              0: {
                  items: 1
              },
              480: {
                  items: 1
              },
              768: {
                  items: 1
              }
          }
      });      
    });
    </script>
  </body>
</html>