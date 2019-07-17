@extends('admin.layout.main')
@section('title')
Danh sách tài khoản
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Danh sách tài khoản</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if($data)
                            <table class="table table-bordered myTable">
                                <thead>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Tài khoản
                                        </th>
                                        <th>
                                            Họ tên
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
                                            {{ $v->username }}
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
                                        <td class="text-center">
                                            @if($v->active == 1)
                                            <span class="text-success"><i class="fa fa-user-plus icon-sm"
                                                    aria-hidden="true"></i></span>
                                            @else
                                            <span class="text-danger"><i class="fa fa-user-times icon-sm"
                                                    aria-hidden="true"></i></span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.account.getCreate', ['id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
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
