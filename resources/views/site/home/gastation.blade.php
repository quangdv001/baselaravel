@extends('site.layout.main')
@section('title')
@lang('header.gastation')
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url(./assets/images/subpage-cover.jpg) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>@lang('header.gastation')</span></div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index' )}}"
                            title="Trang chủ">@lang('header.home')</a></li>
                    <li class="breadcrumb-item active"><span>@lang('header.gastation')</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9 border-sm-right">
                    <div class="row">
                        <div class="col">
                            <div class="detail-post">
                                <h1 class="page-title"><a href="#">@lang('header.gastation')</a></h1>
                                <div class="blog-table bg-main">
                                    <h3 class="title"><span>Đại Lý Vé Tàu Livitrans Express Miền Bắc Tại Ga Hải
                                            Phòng</span></h3>
                                    <div class="blog-content">
                                        <p>Phòng Đặt Vé Tàu Du Lịch Livitrans: </p>
                                        <p>Địa chỉ : Số 75 Lương Khánh Thiện - TP. Hải Phòng.</p>
                                        <p>Điện Thoại : 0243. 942. 9918 / Fax : 0243. 942. 9918 </p>
                                    </div>
                                </div>
                                <div class="blog-table bg-main">
                                    <h3 class="title"><span>Đại Lý Vé Tàu Livitrans Express Miền Bắc Tại Ga Hải
                                            Phòng</span></h3>
                                    <div class="blog-content">
                                        <p>Phòng Đặt Vé Tàu Du Lịch Livitrans: </p>
                                        <p>Địa chỉ : Số 75 Lương Khánh Thiện - TP. Hải Phòng.</p>
                                        <p>Điện Thoại : 0243. 942. 9918 / Fax : 0243. 942. 9918 </p>
                                    </div>
                                </div>
                                <div class="blog-table bg-main">
                                    <h3 class="title"><span>Đại Lý Vé Tàu Livitrans Express Miền Bắc Tại Ga Hải
                                            Phòng</span></h3>
                                    <div class="blog-content">
                                        <p>Phòng Đặt Vé Tàu Du Lịch Livitrans: </p>
                                        <p>Địa chỉ : Số 75 Lương Khánh Thiện - TP. Hải Phòng.</p>
                                        <p>Điện Thoại : 0243. 942. 9918 / Fax : 0243. 942. 9918 </p>
                                    </div>
                                </div>
                                <div class="blog-table bg-main">
                                    <h3 class="title"><span>Đại Lý Vé Tàu Livitrans Express Miền Bắc Tại Ga Hải
                                            Phòng</span></h3>
                                    <div class="blog-content">
                                        <p>Phòng Đặt Vé Tàu Du Lịch Livitrans: </p>
                                        <p>Địa chỉ : Số 75 Lương Khánh Thiện - TP. Hải Phòng.</p>
                                        <p>Điện Thoại : 0243. 942. 9918 / Fax : 0243. 942. 9918 </p>
                                    </div>
                                </div>
                                <div class="blog-table bg-main">
                                    <h3 class="title"><span>Đại Lý Vé Tàu Livitrans Express Miền Bắc Tại Ga Hải
                                            Phòng</span></h3>
                                    <div class="blog-content">
                                        <p>Phòng Đặt Vé Tàu Du Lịch Livitrans: </p>
                                        <p>Địa chỉ : Số 75 Lương Khánh Thiện - TP. Hải Phòng.</p>
                                        <p>Điện Thoại : 0243. 942. 9918 / Fax : 0243. 942. 9918 </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('site.layout.sidebar')
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
@endsection
@include('site.layout.sidebar')
