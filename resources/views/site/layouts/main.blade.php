<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- Bootstrap fonts and icons-->
    @include('site.layouts.css')
  </head>
  <body>       
    <div class="page home">
      {{-- HEADER --}}
      @include('site.layouts.header')
      {{-- END HEADER --}}
      <div class="main">
        @yield('content')
      {{-- PARTNERS --}}
      @include('site.layouts.partners', ['partners'=>$partners])
      {{-- END PARTNERS --}}
      <!-- FOOTER BANNER ADD -->
      <div class="section-gap">
        <div class="container">
          <a href="#linkbanner"><img src="https://codecanyon.img.customer.envatousercontent.com/files/224617590/PreviewBanner.jpg?auto=compress%2Cformat&fit=crop&crop=top&w=590&h=300&s=b0af8d76a81b64c671d47aa92545fddf" alt=""  style="width:100%; max-width:100%; max-height: 120px" class="mx-auto d-block" srcset=""></a>
        </div>
      </div>
      <!-- END FOOTER BANNER ADD -->
        <!-- <div class="section-gap banner-text" style="    background: #ccc url(https://syntec-numerique.fr/sites/default/files/styles/medium/public/Image/finance-syntec-02-02-2017-2.jpg?itok=sXt3wLLF) no-repeat center top / 100% 600%;">
          <div class="container">
            <div class="block-title">
              <h2 class="title">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả</h2>
            </div>
            <p class="text-block">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Được dùng vào việc trình bày và dàn trang phục vụ cho in ấn.</p>
          </div>
        </div> -->
      </div>
      {{-- FOOTER --}}
      @include('site.layouts.footer')
      {{-- END FOOTER --}}
    </div>
    @include('site.layouts.js')
  </body>
</html>