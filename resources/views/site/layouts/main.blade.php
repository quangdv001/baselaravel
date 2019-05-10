{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('site.layouts.header')
    @yield('content')
    @include('site.layouts.footer')
</body>
</html> --}}

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- Bootstrap fonts and icons-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/font-roboto/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/material-design-icons/css/material-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/fontawesome5/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/bootstrap-material/css/bootstrap-material-design.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/owlcarousel2/assets/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/libs/owlcarousel2/assets/owl.theme.default.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme.css') }}" type="text/css">
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
        <div class="section-gap banner-text" style="    background: #ccc url(https://syntec-numerique.fr/sites/default/files/styles/medium/public/Image/finance-syntec-02-02-2017-2.jpg?itok=sXt3wLLF) no-repeat center top / 100% 600%;">
          <div class="container">
            <div class="block-title">
              <h2 class="title">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả</h2>
            </div>
            <p class="text-block">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Được dùng vào việc trình bày và dàn trang phục vụ cho in ấn.</p>
          </div>
        </div>
      </div>
      {{-- FOOTER --}}
      @include('site.layouts.footer')
      {{-- END FOOTER --}}
    </div>
    <script src="{{ asset('assets/frontend/libs/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/libs/popper/umd/popper.js') }}"></script>
    <script src="{{ asset('assets/frontend/libs/bootstrap-material/js/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/libs/owlcarousel2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/libs/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
  </body>
</html>