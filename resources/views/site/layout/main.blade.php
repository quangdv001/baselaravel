<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Livitrans')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('public/assets/site/themes/assets/images/logo.png') }}"/>
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
    <input type="hidden" class="success_message" value="{{ session()->has('success_message') ? session('success_message') : '' }}">
    <input type="hidden" class="error_message" value="{{ session()->has('error_message') ? session('error_message') : '' }}">
    @include('site.layout.js')
  </body>
</html>