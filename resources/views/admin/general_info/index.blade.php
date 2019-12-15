@extends('admin.layout.main')
@section('title')
Danh sách Trang nội dung
@endsection
@inject('Service', 'App\Services\GeneralInfoService' )
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    {{-- <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li> --}}
    <li class="breadcrumb-item active">Page</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Danh sách bài viết</div>
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
                                            Trạng thái
                                        </th>
                                        <th>
                                            Loại
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
                                            {!! $v->status == $Service::STATUS_ACTIVE ? '<span class="badge badge-success">Hoạt động</span>' : '<span class="badge badge-danger">Không hoạt động</span>' !!}
                                        </td>
                                        <td>
                                            @switch($v->type)
                                                @case($Service::TYPE_TEXT)
                                                <span class="badge badge-info">Text</span>
                                                @break
                                                @case($Service::TYPE_SOCIAL)
                                                <span class="badge badge-info">Social</span>
                                                @break
                                                @case($Service::TYPE_IMAGE)
                                                <span class="badge badge-info">Image</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.generalInfo.getCreate', [ 'id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                            -
                                            <a href="{{ route('admin.generalInfo.remove', [ 'id' => $v->id]) }}"
                                                class="text-danger"><i class="fa fa-trash-o icon-sm"
                                                    aria-hidden="true"></i></a>
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
