<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Quản lý nhà trọ')</title>
    <link href="{{ asset('public/assets/site/themes/assets/images/logo.png') }}" rel="icon" type="image/x-icon" />
    @include('my.layout.css')
  </head>
<body>
  <!-- ==============Start Header App============== -->
  @include('my.layout.header')

  <!-- ==============End Header App============== -->
  @yield('content')


  <input type="hidden" class="success_message" value="{{ session()->has('success_message') ? session('success_message') : '' }}">
  <input type="hidden" class="error_message" value="{{ session()->has('error_message') ? session('error_message') : '' }}">
  @include('site.layout.js')
</body>
</html>