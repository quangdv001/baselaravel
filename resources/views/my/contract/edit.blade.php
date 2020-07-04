@extends('my.layout.main')
@section('title')
@if($id > 0) Chỉnh sửa Hợp đồng @else Thêm mới hợp đồng @endif
@endsection
@section('menu4')
active
@endsection
@section('lib_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                            Hợp đồng - @if($id > 0) chỉnh sửa @else thêm mới @endif
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên hợp đồng * : </label>
                                        <input type="text" name="name" class="form-control" value="{{ $data ? $data->name : old('name') }}" required>
                                        @if($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Người đại diện * : </label>
                                            <select class="form-control select2" name="customer_id" id="">
                                                @if(!empty($listCustomer))
                                                    @foreach($listCustomer as $customer)
                                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Phòng trọ * : </label>
                                            <select class="form-control select2" name="motel_room_id" id="" {{!empty(request('room_id'))?'readonly':''}}>
                                                @if(!empty($listRoom))
                                                    @foreach($listRoom as $room)
                                                        <option value="{{$room->id}}" {{ !empty(request('room_id')) && request('room_id') == $room->id ? 'selected' : ''  }}>{{$room->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Dịch vụ * : </label>
                                            <select class="form-control select2" name="service[]" multiple="multiple">
                                                @if(!empty($listService))
                                                    @foreach($listService as $service)
                                                        <option value="{{$service->id}}" @if(in_array($service->id, $arrService)) selected @endif>{{$service->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Chú thích * : </label>
                                            <textarea type="text" name="note" class="form-control" rows="5" required>{{ $data ? $data->note : old('note') }}</textarea>
                                            @if($errors->has('note'))
                                            <p class="text-danger">{{ $errors->first('note') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tiền cọc *: </label>
                                            <input type="number" name="deposits" class="form-control" required value="{{ $data ? $data->deposits : old('deposits') }}">
                                            @if($errors->has('deposits'))
                                            <p class="text-danger">{{ $errors->first('deposits') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Thời hạn thanh toán * : </label>
                                            <input type="text" name="payment_period" class="form-control date" value="{{ $data ? $data->payment_period : old('payment_period') }}" required>
                                            @if($errors->has('payment_period'))
                                                <p class="text-danger">{{ $errors->first('payment_period') }}</p>
                                            @endif
                                        </div>
                                    </div> --}}
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Thời hạn * : </label>
                                        <input type="number" name="duration" class="form-control" value="{{ $data ? $data->duration : (!empty(old('duration')?old('duration'):1)) }}" required>
                                        @if($errors->has('duration'))
                                        <p class="text-danger">{{ $errors->first('duration') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Bắt đầu * : </label>
                                            <input type="text" name="start" class="form-control date" value="{{ $data ? date('d-m-Y', $data->start) : old('start') }}" required>
                                            @if($errors->has('start'))
                                                <p class="text-danger">{{ $errors->first('start') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Kết thúc : </label>
                                            <input type="text" name="end" class="form-control" readonly value="{{ $data ? date('d-m-Y', $data->end) : (!empty( old('end') )?old('end'):date('d/m/Y',strtotime("+1 month") )) }}" required>
                                            @if($errors->has('end'))
                                                <p class="text-danger">{{ $errors->first('end') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticDes" class="col-form-label">Trạng thái * : </label>
                                            <select class="form-control select2" name="status" id="exampleFormControlSelect2">
                                                <option value="1">Hoạt động</option>
                                                <option value="0" @if(isset($data->status) && $data->status == 0) selected
                                                    @endif>Ngừng hoạt động</option>
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
@section('lib_js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function () {
            $('.date').daterangepicker({
                minDate:0,
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                }
            });
            $('.select2').select2();
            $('input[name="start"]').on('change',function () {
                editTimeEnd()
            });
            $('input[name="duration"]').on('change',function () {
                editTimeEnd()
            });
        });
        function editTimeEnd() {
            let duration = $('input[name="duration"]').val();
            let valStart = $('input[name="start"]').val();
            let arrStart = valStart.split("/");
            valStart = arrStart[1]+"/"+arrStart[0]+"/"+arrStart[2];
            let start = new Date(valStart);
            let end  = new Date(start.setMonth(start.getMonth()+parseInt(duration)));
            let valEnd= (end.getDate()>9?end.getDate():'0'+end.getDate())+ '/'+(end.getMonth()+1>9?end.getMonth()+1:'0'+(end.getMonth()+1))+'/'+end.getFullYear();
            $('input[name="end"]').val(valEnd);
        }
    </script>
@endsection

