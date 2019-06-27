<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Homefun')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap fonts and icons-->
    @include('site.layout.css')
  </head>
  <body>       
    <div class="page home">
      @include('site.layout.header')
      @yield('content')
      @include('site.layout.footer')
    </div>
    @include('site.layout.js')
  </body>
</html>