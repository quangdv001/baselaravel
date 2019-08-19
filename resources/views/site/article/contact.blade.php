@extends('site.layout.main')
@section('title')
@lang('header.contact')
@endsection
@section('content')
<div class="detail-post container">
    <h1 class="page-title"><a href="#">Liên hệ </a></h1>
    <div class="row">
        <div class="col-md-6">
            <div class="z-depth-1-half map-container" style="width: 100%;height: 500px">
                <iframe
                    src="https://maps.google.com/maps?q=ga%20h%C3%A0%20n%E1%BB%99i&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                    frameborder="0" style="width: 100%; height: 500px; border:0" allowfullscreen> </iframe>
            </div>
        </div>
        <div class="col-md-6">
            <!-- <p>CÔNG TY CP VẬN TẢI VÀ THƯƠNG MẠI LIVITRANS ( LIVITRANS JSC,..).</p> -->
            <ul class="list-categories">
            <!-- <li><a href="#"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.footer_1') @if(isset($social['phong-tien-khach'])) {!! $social['phong-tien-khach'] !!} @endif </a></li>
                            <li><a><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.footer_2') @if(isset($social['dia-chi-phong-ve'])) {!! $social['dia-chi-phong-ve'] !!} @endif</a></li>
                            <li><a href="@if(isset($social['hotline'])) tell:{!! $social['hotline'] !!} @else # @endif"><i
                                        class="material-icons list-style">fiber_manual_record</i><i
                                        class="material-icons">phone_in_talk</i> @lang('footer.footer_3') @if(isset($social['hotline'])) {!! $social['hotline'] !!} @endif</a></li>
                            <li><a href="@if(isset($social['dien-thoai-phong-ve'])) tell:{!! $social['dien-thoai-phong-ve'] !!} @else # @endif"><i
                                        class="material-icons list-style">fiber_manual_record</i><i
                                        class="material-icons">phone_in_talk</i> @lang('footer.footer_4') @if(isset($social['dien-thoai-phong-ve'])) {!! $social['dien-thoai-phong-ve'] !!} @endif</a>
                            </li>
                            <li><a href="mailto:booking@livitrans.com"><i
                                        class="material-icons list-style">fiber_manual_record</i><i
                                        class="material-icons">mail_outline</i> @lang('footer.footer_5') @if(isset($social['email'])) {!! $social['email'] !!} @endif</a></li>-->
                @if(isset($social['phong-tien-khach']))
                    <li>
                        <a href="#"><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.footer_1')  {!! $social['phong-tien-khach'] !!}  </a>
                    </li>
                    @endif
                    @if(isset($social['dia-chi-phong-ve']))
                    <li><a><i class="material-icons list-style">fiber_manual_record</i>@lang('footer.footer_2')  {!! $social['dia-chi-phong-ve'] !!} </a></li>
                    @endif
                    @if(isset($social['hotline']))
                    <li><a href="@if(isset($social['hotline'])) tell:{!! $social['hotline'] !!} @else # @endif"><i
                                class="material-icons list-style">fiber_manual_record</i><i
                                class="material-icons">phone_in_talk</i> @lang('footer.footer_3')  {!! $social['hotline'] !!} </a>
                    </li>
                    @endif
                    @if(isset($social['dien-thoai-phong-ve']))
                    <li><a href="@if(isset($social['dien-thoai-phong-ve'])) tell:{!! $social['dien-thoai-phong-ve'] !!} @else # @endif"><i
                                class="material-icons list-style">fiber_manual_record</i><i
                                class="material-icons">phone_in_talk</i> @lang('footer.footer_4')  {!! $social['dien-thoai-phong-ve'] !!} </a>
                    </li>
                    @endif
                    @if(isset($social['email']))
                    <li><a href="mailto:booking@livitrans.com"><i
                                class="material-icons list-style">fiber_manual_record</i><i
                                class="material-icons">mail_outline</i> @lang('footer.footer_5') {!! $social['email'] !!} </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <div class="form-services-layout">
        <form class="form form-services">
            <div class="container">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="bmd-label-floating" for="item-form-0">Họ tên</label>
                        <input class="form-control" type="text" placeholder="Nhập họ tên" id="item-form-0" /><span
                            class="float-icon"><i class="material-icons">person</i></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="bmd-label-floating" for="item-form-1">Email</label>
                        <input class="form-control" type="text" placeholder="Nhâp email" id="item-form-1" /><span
                            class="float-icon"><i class="material-icons">mail</i></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="bmd-label-floating" for="item-form-2">Số điện thoại</label>
                        <input class="form-control" type="text" placeholder="Nhập số điện thoại"
                            id="item-form-2" /><span class="float-icon"><i class="material-icons">phone</i></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="bmd-label-floating" for="item-form-3">Thông điệp</label>
                        <textarea class="form-control" type="textarea" name="note" rows="6" placeholder="Nhập thông tin"
                            id="item-form-3"></textarea>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary text-uppercase" type="submit">Gửi thông tin</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('custom_js')
@endsection
