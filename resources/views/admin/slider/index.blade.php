@extends('admin.layout.main')
@section('title')
Danh sách ảnh slide
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">Slider</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Danh sách ảnh slide</div>
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
                                            Tên ảnh
                                        </th>
                                        <th>
                                            Ảnh
                                        </th>
                                        <th>
                                            Vị trí
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
                                            {{ $v->title }}
                                        </td>
                                        <td>
                                            <img class="img-show"
                                                style="width:60px !important; height:60px !important; border-radius:0 !important;"
                                                src="{{ $v->img }}" />
                                        </td>
                                        <td>
                                            {{ $v->position }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.slider.getCreate', ['id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                            -
                                            <a href="{{ route('admin.slider.remove', ['id' => $v->id]) }}" onclick="return confirm('Bạn chắc muốn xóa chứ?')"
                                                class="text-warning"><i class="fa fa-trash-o icon-sm"
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
