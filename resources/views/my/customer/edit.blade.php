@extends('my.layout.main')
@section('title')
@if($id > 0) Chỉnh sửa Khách @else Thêm mới Khách @endif
@endsection
@section('menu6')
active
@endsection
@section('content')
<main class="site-main">
    <section class="site-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 offset-lg-1 col-md-12">
                    @include('my.layout.sidebar')
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="card border-light mt-5">
                        <div class="card-header">
                            Khách hàng - @if($id > 0) chỉnh sửa @else đăng bài @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên khách * : </label>
                                        <input type="text" name="name" class="form-control" value="{{ $data ? $data->name : old('name') }}" required>
                                        @if($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">SĐT * : </label>
                                        <input type="text" name="phone" class="form-control" value="{{ $data ? $data->phone : old('phone') }}" required>
                                        @if($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Email: </label>
                                        <input type="email" name="email" class="form-control" value="{{ $data ? $data->email : old('email') }}">
                                        @if($errors->has('email'))
                                        <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Số CMT * : </label>
                                        <input type="text" name="id_number" class="form-control" value="{{ $data ? $data->id_number : old('id_number') }}" required>
                                        @if($errors->has('id_number'))
                                        <p class="text-danger">{{ $errors->first('id_number') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Nơi cấp * : </label>
                                        <input type="text" name="id_place" class="form-control" value="{{ $data ? $data->id_place : old('id_place') }}" required>
                                        @if($errors->has('id_place'))
                                        <p class="text-danger">{{ $errors->first('id_place') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Thời gian cấp * : </label>
                                        <input type="text" name="id_time" class="form-control" value="{{ $data ? $data->id_time : old('id_time') }}" required>
                                        @if($errors->has('id_time'))
                                        <p class="text-danger">{{ $errors->first('id_time') }}</p>
                                        @endif
                                        </div>
                                    </div> --}}
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Địa chỉ * : </label>
                                            <input type="text" name="address" class="form-control" value="{{ $data ? $data->address : old('address') }}" required>
                                            @if($errors->has('address'))
                                            <p class="text-danger">{{ $errors->first('address') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Trạng thái * : </label>
                                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                                <option value="1">Hoạt động</option>
                                                <option value="0" @if(isset($data->status) && $data->status == 0) selected
                                                    @endif>Ngừng
                                                    hoạt
                                                    động</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-5 col-auto"></div>
                                        <div class="col ml-2">
                                        <a href="{{ route('my.customer.getList') }}" class="btn btn-secondary"><i
                                                    class="far fa-times-circle mr-2"></i>Trở lại</a>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-check mr-2"></i>Đồng ý</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

