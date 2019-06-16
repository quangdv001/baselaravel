@extends('admin.layout.main')
@section('title')
Danh sách khách hàng
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    {{-- <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li> --}}
    <li class="breadcrumb-item active">Khách hàng</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Lọc</div>
                    <div class="card-body">
                        <form class="forms-sample" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Tên</label>
                                        <input type="text" class="form-control" id="exampleInputName1" name="name"
                                            placeholder="Tên" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Email</label>
                                        <input type="text" class="form-control" id="exampleInputName1" name="email"
                                            placeholder="Tên" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">SĐT</label>
                                        <input type="text" class="form-control" id="exampleInputName1" name="phone"
                                            placeholder="SĐT" value="{{ old('phone') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect3">Trạng thái</label>
                                        <select class="form-control" name="status" id="exampleFormControlSelect3">
                                            <option value="-1">Mời chọn</option>
                                            <option @if(old('status')==0) selected @endif value="0">Chưa kích hoạt
                                            </option>
                                            <option @if(old('status')==1) selected @endif value="1">Hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success mr-2 mt-4">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Danh sách khách hàng</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($data)
                            <table class="table table-bordered myTable1">
                                <thead>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Tên
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            SĐT
                                        </th>
                                        <th>
                                            Trạng thái
                                        </th>
                                        <th>
                                            Thời gian tạo
                                        </th>
                                        <th>
                                            Hành động
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $v)
                                    <tr>
                                        <td>
                                            {{ $v->id }}
                                        </td>
                                        <td>
                                            {{ $v->name }}
                                        </td>
                                        <td>
                                            {{ $v->email }}
                                        </td>
                                        <td>
                                            {{ $v->phone }}
                                        </td>
                                        <td>
                                            <span
                                                class="{{ isset($userBadge[$v->status]) ? $userBadge[$v->status] : 'badge badge-primary' }}">{{ isset($userStatus[$v->status]) ? $userStatus[$v->status] : '--' }}</span>
                                        </td>
                                        <td>
                                            {{ $v->created_at }}
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.user.updateStatus', $v->id) }}" method="POST">
                                                @csrf
                                                <button class="btn @if($v->status == 0) btn-ghost-success @else  btn-ghost-danger @endif " type="submit" onclick="return confirm('Are you sure!');"><i
                                                        class="fa fa-pencil-square-o icon-sm"
                                                        aria-hidden="true"></i></button>
                                            </form>
                                            {{-- -
                                            <a href="{{ route('admin.product.remove', ['id' => $v->id]) }}"
                                            class="text-warning"><i class="fa fa-trash-o icon-sm"
                                                aria-hidden="true"></i></a> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="wrap-link">
                                <div class="pull-right mt-4">{{ $data->links() }}</div>
                            </div>

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
