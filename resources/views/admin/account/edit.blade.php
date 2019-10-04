@extends('admin.layout.main')
@section('title')
    {{ $id > 0 ? 'Cập nhật tài khoản' : 'Tạo tài khoản' }}
@endsection
@section('content')
    <form class="forms-sample" action="" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin cơ bản</h4>

                        <div class="form-group">
                            <label>Tài khoản</label>
                            <input type="text" class="form-control" @if($id == 0) name="username" @else readonly @endif placeholder="Tài khoản" value="{{ isset($data->username) ? $data->username : old('username') }}">
                            @if($errors->has('username'))
                                <p class="text-danger">{{ $errors->first('username') }}</p>
                            @endif
                        </div>
                        @if($id == 0)
                        <div class="form-group">
                            <label for="">Mật khẩu</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="*********" value="{{ old('password') }}">
                            @if($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Họ tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Họ tên" value="{{ isset($data->name) ? $data->name : old('name') }}">
                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ isset($data->email) ? $data->email : old('email') }}">
                            @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ isset($data->phone) ? $data->phone : old('phone') }}">
                            @if($errors->has('phone'))
                                <p class="text-danger">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Hoạt động</label>
                            <select class="form-control" id="exampleFormControlSelect2">
                                <option value="1">Hoạt động</option>
                                <option value="0" @if(isset($data->active) && $data->active == 0) selected @endif>Ngừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mr-2 has-spinner">{{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                        <a href="{{ route('admin.account.getList') }}" class="btn btn-light">Hủy</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Phân quyền</h4>
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
                                                            <input type="checkbox" name="permission[]" value="{{ $val->code }}" class="form-check-input"
                                                            @if(isset($data->permissions) && str_contains($data->permissions, $val->code)) checked @endif> {{ $val->name }}
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
                </div>
            </div>
        </div>
    </form>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function(){
            //
        })
    </script>
@endsection