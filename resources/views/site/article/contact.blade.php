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
            <p>CÔNG TY CP VẬN TẢI VÀ THƯƠNG MẠI LIVITRANS ( LIVITRANS JSC,..).</p>
            <ul class="list-categories">
                <li><a href="#address:"> Phòng tiễn khách: Khách sạn Cây Xoài 118 Lê Duẩn - Hoàn Kiếm - Hà Nội</a></li>
                <li><a> Địa chỉ Phòng vé: Số 1 Trần Quý Cáp - Phường Văn Miếu - Quận Đống Đa - Hà nội</a></li>
                <li><a href="tell:0243.9429918"> <i class="material-icons">phone_in_talk</i> Hotline: 0243.9429918</a>
                </li>
                <li><a href="tell: 0904.101.488"> <i class="material-icons">phone_in_talk</i> Điện thoại phòng vé:
                        0904.101.488</a></li>
                <li><a href="mailto:booking@livitrans.com"> <i class="material-icons">mail_outline</i> Email:
                        booking@livitrans.com</a></li>
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
                        <textarea class="form-control" type="textarea" rows="6" placeholder="Nhập thông tin"
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
