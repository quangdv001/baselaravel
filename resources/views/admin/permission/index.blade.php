@extends('admin.layout.main')
@section('title')
Phân quyền
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
    <!-- Breadcrumb Menu-->
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="#">
                <i class="icon-speech"></i>
            </a>
            <a class="btn" href="./">
                <i class="icon-graph"></i>  Dashboard</a>
            <a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>
        </div>
    </li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Danh sách nhóm quyền</div>
                    <div class="card-body">
                        <div class="table-responsive ">
                            @if($data)
                            <table class="table table-bordered myTable permission-content">
                                <thead>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Tên nhóm quyền
                                        </th>
                                        <th>
                                            Nhóm quyền
                                        </th>
                                        <th>
                                            Hành động
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="">

                                    @foreach($data as $v)
                                    <tr>
                                        <td>
                                            {{ $v->id }}
                                        </td>
                                        <td>
                                            {{ $v->name }}
                                        </td>
                                        <td>
                                            @if(sizeof($v->permission) > 0)
                                            @foreach($v->permission as $val)
                                            <p>- {{ $val->name }} <span class="text-danger">({{ $val->code }})</span>
                                            </p>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.permission.getCreate', ['id' => $v->id]) }}"
                                                class="text-warning mr-4"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                            <a href="{{ route('admin.permission.removeGroup', ['id' => $v->id]) }}"
                                                class="text-danger rm_group_btn"><i class="fa fa-trash icon-sm"
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
