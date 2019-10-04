<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Ratraco')</title>
    <link rel="shortcut icon" href="{{ asset('assets/admin/themes/images/favicon.png') }}" />
    @include('admin.layout.css')
</head>

<body>
{{-- <div id="loader-wrapper">
    <div id="loader"></div>
</div> --}}
<div class="container-scroller">
    @include('admin.layout.header')
    <div class="container-fluid page-body-wrapper">
        @include('admin.layout.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
</div>
<input type="hidden" class="success_message" value="{{ session()->has('success_message') ? session('success_message') : '' }}">
<input type="hidden" class="error_message" value="{{ session()->has('error_message') ? session('error_message') : '' }}">
@include('admin.layout.js')
</body>

</html>