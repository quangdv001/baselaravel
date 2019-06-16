@extends('admin.layout.main')
@section('title')
Chi tiết đơn hàng
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.order.getList') }}">Đơn hàng</a>
    </li>
    <li class="breadcrumb-item active">Đơn hàng #{{ $data->id }}</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <form action="" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> Đơn hàng #{{ $data->id }}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>order #{{ $data->id }}</p>
                                    <p>
                                        <span
                                            class="{{ isset($orderBadge[$data->status]) ? $orderBadge[$data->status] : 'badge badge-primary' }}">{{ isset($orderStatus[$data->status]) ? $orderStatus[$data->status] : '--' }}</span>
                                    </p>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <select class="form-control form-control-sm" id="select1" name="status">
                                                    @foreach($orderStatus as $k => $v)
                                                    <option @if($data->status==$k) selected @endif value="{{ $k }}">{{ $v }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button class="btn btn-sm btn-primary" type="submit">
                                                <i class="fa fa-dot-circle-o"></i> Cập nhật trạng thái</button>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <p>{{ $data->orderInfo->name }}</p>
                                    <p>{{ $data->orderInfo->email }}</p>
                                    <p>{{ $data->orderInfo->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Chi tiết đơn hàng</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($data->orderDetail)
                            <table class="table table-bordered myTable1">
                                <thead>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Id sản phẩm
                                        </th>
                                        <th>
                                            Tên sản phẩm
                                        </th>
                                        <th>
                                            Ảnh
                                        </th>
                                        <th>
                                            Số lượng
                                        </th>
                                        <th>
                                            Kích thước (dài x rộng x cao)
                                        </th>
                                        <th>
                                            Đơn giá
                                        </th>
                                        <th>
                                            Tổng tiền
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->orderDetail as $v)
                                    <tr>
                                        <td>
                                            {{ $v->id }}
                                        </td>
                                        <td>
                                            {{ $v->product_id }}
                                        </td>
                                        <td>
                                            {{ $v->title }}
                                        </td>
                                        <td>
                                            {{ $v->img }}
                                        </td>
                                        <td>
                                            {{ $v->qty }}
                                        </td>
                                        <td>
                                            {{ $v->width }}x{{ $v->depth }}x{{ $v->height }}
                                        </td>
                                        <td>
                                            {{ number_format($v->price, 0,",",".") }}đ
                                        </td>
                                        <td>
                                            {{ number_format($v->total, 0,",",".") }}đ
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="7" class="ml-auto">
                                            <span class="float-right">Tổng</span>
                                        </td>
                                        <td>{{ number_format($data->total, 0,",",".") }}đ</td>
                                    </tr>
                                </tbody>
                            </table>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
</div>
@endsection
