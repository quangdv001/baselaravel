<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="{{ asset('/assets/frontend/css/login/main.css') }}">
  <title>Register</title>
</head>
<body>
  <form class="form" method="POST">
  @csrf
    <div class="form__group">
      <h1 class="form__title">Đăng ký dùng thử phần mềm</h1>
      <span class="from__description">Vui lòng nhập thông tin chúng tôi sẽ liên hệ lại với bạn để tư vấn và hỗ trợ bạn sử dụng phần mềm</span>
    </div>

    <div class="form__group">
        <label>Email *</label>
        <input placeholder="Nhập email" name="email" id="email" type="email" class="form__control">
        @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
        @endif
    </div>

    <div class="form__group">
        <label>Password *</label>
        <input placeholder="Nhập password" name="password" id="password" type="password" class="form__control">
        @if($errors->has('password'))
            <p class="text-danger">{{ $errors->first('password') }}</p>
        @endif
    </div>

    <div class="form__group">
        <label>Họ và tên</label>
        <input placeholder="Nhập họ và tên" name="name" id="name" type="text" class="form__control">
    </div>

    <div class="form__group">
        <label>Số điện thoại</label>
        <input placeholder="Nhập số điện thoại" type="text" name="phone" id="phone" class="form__control">
        @if($errors->has('phone'))
            <p class="text-danger">{{ $errors->first('phone') }}</p>
        @endif
    </div>

    <div class="form__group">
        <label>Địa chỉ</label>
        <input placeholder="Nhập địa chỉ" name="address" id="address" type="text" class="form__control">
    </div>

    <div class="form__group">
        <button :disabled="isProcessing" class="btn btn-primary" type="submit">Đăng ký</button>
    </div>
  </form>
</body>
</html>