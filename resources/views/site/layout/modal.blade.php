<div class="modal fade" id="login-panel" tabindex="-1" role="dialog" aria-labelledby="modal-panel-label" aria-hidden="true">
    <!-- LOGIN-->
    <div class="modal-dialog login-panel">
      <div class="modal-content">
        <div class="modal-body">
          <div class="header">
            <h3 class="title text-uppercase" id="modal-panel-label">Đăng nhập tài khoản</h3>
          </div>
        <form method="post" action="{{ route('site.auth.postLogin') }}" class="form">
            @csrf
            <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">person</span><span class="isMobile">Email</span></label>
              <div class="col">
                <input class="form-control" name="email" type="email" placeholder="Nhập email..." required/>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">vpn_key</span><span class="isMobile">Mật khẩu</span></label>
              <div class="col">
                <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu..." required/>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <div class="col">
                <div>
                  <button class="btn btn-primary" type="submit">Đăng nhập</button>
                </div>
                <div><a class="helper-link" href="javascript:void(0);">Quên mật khẩu? </a></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="register-panel" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <!-- REGISTER-->
    <div class="modal-dialog login-panel">
      <div class="modal-content">
        <div class="modal-body">
          <div class="header">
            <h3 class="title text-uppercase" id="modal-register-label">Đăng ký tài khoản</h3>
            <p>* Đăng ký tài khoản cho phép đăng thông tin dự án, giao dịch bất động sản.</p>
          </div>
        <form method="post" action="{{ route('site.auth.postRegister') }}" id="form-register">
          @csrf
            <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">mail_outline</span><span class="isMobile">Email</span></label>
              <div class="col">
                <input class="form-control" type="email" name='email' placeholder="Nhập email..." required/>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">person</span><span class="isMobile">Tên</span></label>
              <div class="col">
                <input class="form-control" name="name" placeholder="Nhập họ tên..." required/>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">phone_in_talk</span><span class="isMobile">Điện thoại</span></label>
              <div class="col">
                <input class="form-control" name="phone" placeholder="Nhập số điện thoại..." required/>
              </div>
            </div>
            <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">vpn_key</span><span class="isMobile">Mật khẩu</span></label>
              <div class="col">
                <input class="form-control" name="password" type="password" placeholder="Nhập mật khẩu..." required/>
              </div>
            </div>
            {{-- <div class="form-group row justify-content-center">
              <label class="col-auto col-form-label icon-form-label"><span class="material-icons">vpn_key</span><span class="isMobile">Nhập lại mật khẩu</span></label>
              <div class="col">
                <input class="form-control" type="password" placeholder="Nhập mật lại khẩu..."/>
              </div>
            </div> --}}
            <div class="form-group row justify-content-center">
              <div class="col">
                <div>
                  <button class="btn btn-primary" type="submit">Đăng ký</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>