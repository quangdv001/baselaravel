@extends('my.layout.main')
@section('title')
@if($id > 0) Chỉnh sửa nhà trọ @else Thêm mới nhà trọ @endif
@endsection
@section('menu1')
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
                            Nhà trọ - @if($id > 0) chỉnh sửa @else đăng bài @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên nhà trọ * : </label>
                                        <input type="text" name="name" class="form-control" value="{{ $data ? $data->name : old('name') }}" required>
                                        @if($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                        </div>
                                    </div>
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
                                            <label for="staticStartDate" class="col-form-label">Mô tả * : </label>
                                        <textarea name="description" class="form-control" rows="5">{{ $data ? $data->description : old('description') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-sm-5 col-auto"></div>
                                        <div class="col ml-2">
                                        <a href="{{ route('my.motel.getList') }}" class="btn btn-secondary"><i
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

