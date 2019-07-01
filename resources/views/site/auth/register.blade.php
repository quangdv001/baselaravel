@extends('site.layout.main')
@section('title')
Đăng ký
@endsection
@section('content')
<div class="main">
    <div class="section section-cover d-flex align-items-center">
        <!-- REGISTER-->
        <div class="form-panel-layout" style="width: 850px;">
            <div class="row no-gutters">
                <div class="col-sm-6 cover-image-form"></div>
                <div class="col-sm-6 order-first">
                    <div class="register-panel">
                        <div class="header">
                            <h1 class="title text-uppercase">Đăng ký tài khoản</h1>
                            <p>* Đăng ký tài khoản chỉ dành cho nhà thầu và các đơn vị thiết kế</p>
                        </div>
                        <form action="" method="POST" class="forms-sample">
                            @csrf
                            <div class="form-group row justify-content-center">
                                <label class="col-auto col-form-label icon-form-label"><span
                                        class="material-icons">mail_outline</span><span
                                        class="isMobile">Email</span></label>
                                <div class="col">
                                    <input class="form-control" name="email" placeholder="Nhập email...">
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label class="col-auto col-form-label icon-form-label"><span
                                        class="material-icons">person</span><span
                                        class="isMobile">Tên</span></label>
                                <div class="col">
                                    <input class="form-control" name="name" placeholder="Nhập Tên...">
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label class="col-auto col-form-label icon-form-label"><span
                                        class="material-icons">phone_in_talk</span><span class="isMobile">Điện
                                        thoại</span></label>
                                <div class="col">
                                    <input class="form-control" name="phone" placeholder="Nhập số điện thoại...">
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <label class="col-auto col-form-label icon-form-label"><span
                                        class="material-icons">vpn_key</span><span class="isMobile">Mật
                                        khẩu</span></label>
                                <div class="col">
                                    <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu...">
                                </div>
                            </div>
                            {{-- <div class="form-group row justify-content-center">
                                <label class="col-auto col-form-label icon-form-label"><span
                                        class="material-icons">vpn_key</span><span class="isMobile">Nhập lại mật
                                        khẩu</span></label>
                                <div class="col">
                                    <input class="form-control" type="password" placeholder="Nhập mật lại khẩu...">
                                </div>
                            </div> --}}
                            <div class="form-group row justify-content-center">
                                <div class="col">
                                    <div>
                                        <button class="btn btn-primary has-spinner" type="submit">Đăng ký</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>

</script>
@endsection
