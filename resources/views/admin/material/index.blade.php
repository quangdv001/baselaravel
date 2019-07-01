@extends('admin.layout.main')
@section('title')
Danh sách Vật liệu
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Material</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Danh sách Vật liệu</div>
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
                                            Tên
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
                                            <a href="{{ route('admin.material.getCreate', ['id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                                    -
                                            <a href="{{ route('admin.material.remove', ['id' => $v->id]) }}"
                                                class="text-danger"><i class="fa fa-trash-o icon-sm"
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
