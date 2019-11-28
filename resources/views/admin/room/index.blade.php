@extends('admin.layout.main')
@section('title')
Danh sách Bài viết
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    {{-- <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li> --}}
    <li class="breadcrumb-item active">Article</li>
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
                                        <label for="exampleInputName1">Id</label>
                                        <input type="text" class="form-control" id="" name="id"
                                            placeholder="Tiêu đề" value="{{ old('id') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Tiêu đề</label>
                                        <input type="text" class="form-control" id="" name="title"
                                            placeholder="Tiêu đề" value="{{ old('title') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Tên admin</label>
                                        <input type="text" class="form-control" id=""
                                            placeholder="Tên admin" name="admin_name_c"
                                            value="{{ old('admin_name_c') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Tên người dùng</label>
                                        <input type="text" class="form-control" id=""
                                            placeholder="Tên user" name="user_name_c" value="{{ old('user_name_c') }}">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Loại bài viết</label>
                                        <select class="form-control" name="type" id="exampleFormControlSelect2">
                                            <option @if(old('type')==-1) selected @endif value="-1">Mời chọn</option>
                                            <option @if(old('type')==1) selected @endif value="0">Tin tức</option>
                                            <option @if(old('type')==2) selected @endif value="1">Luật pháp</option>
                                            <option @if(old('type')==3) selected @endif value="2">Dự án</option>
                                            <option @if(old('type')==4) selected @endif value="3">Đối tác</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect3">Trạng thái</label>
                                        <select class="form-control" name="status" id="exampleFormControlSelect3">
                                            <option @if(old('status') == 1) selected @endif value="1">Hoạt động</option>
                                            <option @if(old('status') == 0) selected @endif value="0">Ngừng hoạt động
                                            <option @if(old('status') == null || old('status') == -1) selected @endif value="-1">Mời chọn</option>
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="">&nbsp;</label>
                                        <button type="submit" class="btn btn-success mr-2 d-block">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
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
                                            Ảnh
                                        </th>
                                        <th>
                                            Title
                                        </th>
                                        <th>
                                            Danh mục
                                        </th>
                                        <th>
                                            Trạng thái
                                        </th>
                                        {{-- <th>
                                            Loại bài viết
                                        </th> --}}
                                        <th>
                                            Admin
                                        </th>
                                        <th>
                                            User
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
                                            <img class="img-show"
                                                style="width:60px !important; height:60px !important; border-radius:0 !important;"
                                                src="{{ $v->img }}" />
                                        </td>
                                        <td>
                                            {{ $v->title }}
                                        </td>
                                        <td>
                                            {{ isset($listCategories[$v->category_id]) ? $listCategories[$v->category_id] : 'Chưa chọn danh mục'  }}
                                        </td>
                                        <td>
                                            {!! $v->status == 1 ? '<span class="badge badge-success">Hoạt động</span>' : '<span class="badge badge-danger">Không hoạt động</span>' !!}
                                        </td>
                                        {{-- <td>
                                            {{ $v->type == 1 ? 'Tin tức' : ($v->type == 2 ? 'Luật pháp' :  ($v->type == 3 ? 'Dự án nhà đất' : 'Đối tác')) }}
                                        </td> --}}
                                        <td>
                                            {{ $v->admin_name_c }}
                                        </td>
                                        <td>
                                            {{ $v->user_name_c }}
                                        </td>
                                        <td>
                                            {{ $v->created_at->format('H:i:s d/m/Y') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.article.getCreate', ['type' => $v->type, 'id' => $v->id]) }}"
                                                class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
                                                    aria-hidden="true"></i></a>
                                            -
                                            <a href="{{ route('admin.article.remove', ['type' => $v->type, 'id' => $v->id]) }}"
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
