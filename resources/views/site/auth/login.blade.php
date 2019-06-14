<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/frontend/css/login/main.css') }}">
  <title>Login</title>
</head>
<body>
  <form class="form__login" method="POST">
    @csrf
    <h1 class="form__title">Đăng nhập</h1>
    <div class="form__group">
        <label>Email *</label>
        <input placeholder="Tên đăng nhập" type="text" id="email" name="email" class="form__control">
        @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>

    <div class="form__group">
        <label>Mật khẩu *</label>
        <input placeholder="Mật khẩu" name="password" type="password" class="form__control">
    </div>

    <div class="form__group">
        <button :disabled="isProcessing" class="btn btn-primary">Đăng nhập</button>
    </div>

    <div class="form__group">
        <input type="checkbox" name="saveAccount" value="1"> Ghi nhớ mật khẩu
    </div>

    <div class="form__group">
        <!-- <a class="error__confimr" href="/register.html">Quên mật khẩu ?</a> -->
        <p class="error__question">Bạn chưa có tài khoản?  <a href="{{ route('site.auth.getRegister') }}" class="error__active">Đăng ký</a></p>
    </div>
  </form>
</body>
</html>