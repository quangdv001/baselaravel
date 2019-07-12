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
                                    <p>{{ $data->orderInfo->address }}</p>
                                    {{-- <p>@if($customer && $customer->status == 1) <span class="badge badge-success">Đã kích hoạt</span> @else <span class="badge badge-danger">Chưa kích hoạt</span> @endif</p> --}}
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
                                            Điểm đi
                                        </th>
                                        <th>
                                            Điểm đến
                                        </th>
                                        <th>
                                            Số người
                                        </th>
                                        <th>
                                            Ngày đi
                                        </th>
                                        <th>
                                            Ngày về
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
                                            {{ $v->start_name }}
                                        </td>
                                        <td>
                                            {{ $v->end_name }}
                                        </td>
                                        <td>
                                            {{ $v->qty }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', $v->start_time) }}
                                        </td>
                                        <td>
                                            {{ date('d-m-Y', $v->end_time) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr>
                                        <td colspan="7" class="ml-auto">
                                            <span class="float-right">Tổng</span>
                                        </td>
                                        <td>{{ number_format($data->total, 0,",",".") }}đ</td>
                                    </tr> --}}
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
