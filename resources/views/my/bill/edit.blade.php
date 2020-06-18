@extends('my.layout.main')
@section('title')
 Thêm mới Hóa đơn 
@endsection
@section('menu7')
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
                            Tạo Hóa đơn - hợp đồng "{{ $contract->name }}"
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form method="POST">
                                    @csrf
                                    
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tên hóa đơn * : </label>
                                        <input type="text" name="name" class="form-control" value="" required>
                                        @if($errors->has('name'))
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticStartDate" class="col-form-label">Ghi chú * : </label>
                                        <textarea name="note" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Giá khác * : </label>
                                        <input type="number" name="other_price" class="form-control" value="0" required>
                                        @if($errors->has('other_price'))
                                        <p class="text-danger">{{ $errors->first('other_price') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tiền giảm giá * : </label>
                                        <input type="number" name="discount_price" class="form-control" value="0" required>
                                        @if($errors->has('discount_price'))
                                        <p class="text-danger">{{ $errors->first('discount_price') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="staticFrom" class="col-form-label">Tiền ghi nợ * : </label>
                                        <input type="number" name="debit_price" class="form-control" value="0" required>
                                        @if($errors->has('debit_price'))
                                        <p class="text-danger">{{ $errors->first('debit_price') }}</p>
                                        @endif
                                        </div>
                                    </div>
                                    <br>
                                    @if(sizeof($service) > 0)
                                    <h5>Dịch vụ</h5>
                                    <div class="list-service">
                                        <div class="row">
                                        @foreach($service as $k => $v)
                                            <div class="col-6">
                                                <label for="staticFrom" class="col-form-label">{{ $v->title }} : </label>
                                                <div class="input-group mb-3">
                                                    <input type="number" name="service[{{$v->id}}]" class="form-control" value="0">
                                                    <div class="input-group-append">
                                                    <span class="input-group-text">{{ $v->unit }}</span>
                                                    </div>
                                                  </div>
                                                
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row mt-5">
                                        <div class="col-sm-5 col-auto"></div>
                                        <div class="col ml-2">
                                        <a href="{{ route('my.bill.getList') }}" class="btn btn-secondary"><i
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

