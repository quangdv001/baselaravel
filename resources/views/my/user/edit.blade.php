@extends('my.layout.main')
@section('title')
Chỉnh sửa user
@endsection
@section('menu5')
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
                            Chỉnh sửa user
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên * : </label>
                                        <input type="text" name="name" class="form-control" value="{{ $data ? $data->name : old('name') }}" required>
                                        @if($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">SĐT * : </label>
                                        <input type="text" name="phone" class="form-control" pattern="(0)+([0-9]{9})\b" maxlength="10" minlength="10" value="{{ $data ? $data->phone : old('phone') }}" required>
                                        @if($errors->has('phone'))
                                        <p class="text-danger">{{ $errors->first('phone') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Email *: </label>
                                        <input type="email" name="email" class="form-control" value="{{ $data ? $data->email : old('email') }}" required>
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
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Ngày cấp CMT * : </label>
                                        <input type="text" name="id_time" class="form-control date" value="{{ $data ? date('d-m-Y',$data->id_time) : old('name') }}" required>
                                        @if($errors->has('id_time'))
                                        <p class="text-danger">{{ $errors->first('id_time') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Nơi cấp CMT * : </label>
                                        <input type="text" name="id_place" class="form-control" value="{{ $data ? $data->id_place : old('id_place') }}" required>
                                        @if($errors->has('id_place'))
                                        <p class="text-danger">{{ $errors->first('id_place') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Địa chỉ * : </label>
                                        <input type="text" name="address" class="form-control" value="{{ $data ? $data->address : old('address') }}" required>
                                        @if($errors->has('address'))
                                        <p class="text-danger">{{ $errors->first('address') }}</p>
                                        @endif
                                        </div>
                                    </div>


                                    
                                    
                                    <div class="row mt-5">
                                        <div class="col-sm-5 col-auto"></div>
                                        <div class="col ml-2">
                                        
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fas fa-check mr-2"></i>Lưu</button>
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

@section('lib_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection
@section('lib_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
@section('custom_js')
<script>
    $(document).ready(function(){
        $('.date').daterangepicker({
                minDate:0,
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
    })
</script>
@endsection