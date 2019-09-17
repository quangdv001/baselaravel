@extends('site.layout.main')
@section('title')
Trang Đăng Nhập
@endsection
@section('content')
<div class="main">
        <div class="section section-cover d-flex align-items-center">
          <!-- LOGIN-->
          <div class="login-panel form-panel-layout" style="width: 650px;">
            <div class="header">
              <h1 class="title text-uppercase">Đăng nhập tài khoản</h1>
            </div>
            <form class="form">
              <div class="form-group row justify-content-center">
                <label class="col-auto col-form-label icon-form-label"><span class="material-icons">person</span><span class="isMobile">Email</span></label>
                <div class="col">
                  <input class="form-control" placeholder="Nhập email...">
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <label class="col-auto col-form-label icon-form-label"><span class="material-icons">vpn_key</span><span class="isMobile">Mật khẩu</span></label>
                <div class="col">
                  <input class="form-control" type="password" placeholder="Nhập mật khẩu...">
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col">
                  <div>
                    <button class="btn btn-primary" type="submit">Đăng nhập</button>
                  </div>
                  <div><a class="helper-link" href="/reset-password.html">Quên mật khẩu? </a></div><a class="helper-link" href="/register.html">Bạn chưa có tài khoản, <strong>ĐĂNG KÝ</strong>? </a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
@endsection
