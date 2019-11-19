@extends('admin.layout.main')
@section('title')
Quy định
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">Quy định</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Quy định</div>
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
                                            Tên File
                                        </th>
                                        <th>
                                            Trạng thái
                                        </th>
                                        <th>
                                            Ngày tạo
                                        </th>
                                        <th>
                                            Tùy chọn
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
                                        <a href="{{ route('admin.file.downloadFile', $v->file_id) }}">{{ $v->name }}</a>
                                        </td>
                                        <td>
                                            {{ $v->status == 1 ? 'Hoạt động' : 'Dừng hoạt động' }}
                                        </td>
                                        <td>
                                            {{ $v->created_at }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.regulation.getCreate', ['id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                            -
                                            <a href="{{ route('admin.regulation.remove', ['id' => $v->id]) }}" onclick="return confirm('Bạn chắc muốn xóa chứ?')"
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
