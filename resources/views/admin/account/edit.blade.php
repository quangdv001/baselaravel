@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật tài khoản' : 'Tạo tài khoản' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<form class="forms-sample" action="" method="post">
    @csrf
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thông tin cơ bản</strong></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tài khoản</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" @if($id==0) name="username" @else readonly
                                        @endif placeholder="Tài khoản"
                                        value="{{ isset($data->username) ? $data->username : old('username') }}">
                                    @if($errors->has('username'))
                                    <span class="help-block text-danger">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="password-input">Mật khẩu</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" name="password" placeholder="*********"
                                        value="{{ isset($data->password) ? $data->password : old('password') }}">
                                    @if($errors->has('password'))
                                    <span class="help-block text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Họ tên</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Họ tên"
                                        value="{{ isset($data->name) ? $data->name : old('name') }}">
                                    @if($errors->has('name'))
                                    <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        value="{{ isset($data->email) ? $data->email : old('email') }}">
                                    @if($errors->has('email'))
                                    <span class="help-block text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Số điện thoại</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                                        value="{{ isset($data->phone) ? $data->phone : old('phone') }}">
                                    @if($errors->has('phone'))
                                    <span class="help-block text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="select1">Hoạt động</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="select1" name="active">
                                        <option value="1">Hoạt động</option>
                                        <option value="0" @if(isset($data->active) && $data->active == 0) selected
                                            @endif>Ngừng hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-dot-circle-o"></i> Submit</button>
                            <button class="btn btn-sm btn-danger" type="reset">
                                <i class="fa fa-ban"></i> Reset</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Phân quyền</strong> </div>
                        <div class="card-body">
                            @if($group)
                            <div class="row">
                                @foreach($group as $v)
                                <div class="col-md-3">
                                    <p class="text-uppercase">{{ $v->name }}</p>
                                    @if($v->permission)
                                    <div class="form-group">
                                        @foreach($v->permission as $val)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="permission[]" value="{{ $val->code }}"
                                                    class="form-check-input" @if(isset($data->permissions) &&
                                                str_contains($data->permissions, $val->code)) checked @endif>
                                                {{ $val->name }}
                                            </label>
                                        </div>
                                        @endforeach

                                    </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            {{-- <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-dot-circle-o"></i> Submit</button>
                            <button class="btn btn-sm btn-danger" type="reset">
                                <i class="fa fa-ban"></i> Reset</button> --}}
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>
</form>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
        //
    })

</script>
@endsection
