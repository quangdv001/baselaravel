@extends('admin.layout.main')
@section('title')
Album Ảnh
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item active">Album ảnh</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>Album ảnh</div>
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
                                            Image
                                        </th>
                                        <th>
                                            Nội dung tiếng việt
                                        </th>
                                        <th>
                                            Nội dung tiếng anh
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
                                            <img class="img-show"
                                                style="width:60px !important; height:60px !important; border-radius:0 !important;"
                                                src="{{ $v->image }}" />
                                        </td>
                                        <td>
                                            {{ $v->content_vi }}
                                        </td>
                                        <td>
                                            {{ $v->content_en }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.image.getCreate', ['id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                            -
                                            <a href="{{ route('admin.image.remove', ['id' => $v->id]) }}" onclick="return confirm('Bạn chắc muốn xóa chứ?')"
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
