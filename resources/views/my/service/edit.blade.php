@extends('my.layout.main')
@section('title')
@if($id > 0) Chỉnh sửa dịch vụ @else Thêm mới dịch vụ @endif
@endsection
@section('menu3')
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
                            Dịch vụ - @if($id > 0) chỉnh sửa @else đăng bài @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên dịch vụ * : </label>
                                        <input type="text" name="title" class="form-control" value="{{ $data ? $data->title : old('title') }}" required>
                                        @if($errors->has('title'))
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">đơn vị * : </label>
                                        <input type="text" name="unit" class="form-control" value="{{ $data ? $data->unit : old('unit') }}" required>
                                        @if($errors->has('unit'))
                                        <p class="text-danger">{{ $errors->first('unit') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Giá * : </label>
                                            <input type="number" name="price" class="form-control" value="{{ $data ? $data->price : 0 }}" required>
                                            @if($errors->has('price'))
                                            <p class="text-danger">{{ $errors->first('price') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Giá cố định * : </label>
                                            <input type="number" name="fixed_price" class="form-control" value="{{ $data ? $data->fixed_price : 0 }}" required>
                                            @if($errors->has('fixed_price'))
                                            <p class="text-danger">{{ $errors->first('fixed_price') }}</p>
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

