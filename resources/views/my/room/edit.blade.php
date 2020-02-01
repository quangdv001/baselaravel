@extends('my.layout.main')
@section('title')
@if($id > 0) Chỉnh sửa phòng trọ @else Thêm mới phòng trọ @endif
@endsection
@section('menu2')
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
                            Phòng trọ - @if($id > 0) chỉnh sửa @else đăng bài @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Khách sạn * : </label>
                                            <select class="form-control" name="motel_id" id="">
                                                <option value="0">Mời chọn</option>
                                                @if(sizeof($motel) > 0) 
                                                @foreach($motel as $v) 
                                                    <option value="{{ $v->id }}" @if(($data && $data->motel_id == $v->id) || old('motel_id') == $v->id) selected @endif>{{ $v->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if($errors->has('motel_id'))
                                            <p class="text-danger">{{ $errors->first('motel_id') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên phòng trọ * : </label>
                                        <input type="text" name="name" class="form-control" value="{{ $data ? $data->name : old('name') }}" required>
                                        @if($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Tầng * : </label>
                                            <input type="number" name="floor" class="form-control" value="{{ $data ? $data->floor : 1 }}" required>
                                            @if($errors->has('floor'))
                                            <p class="text-danger">{{ $errors->first('floor') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Số người * : </label>
                                            <input type="number" name="max" class="form-control" value="{{ $data ? $data->max : 1 }}" required>
                                            @if($errors->has('max'))
                                            <p class="text-danger">{{ $errors->first('max') }}</p>
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

