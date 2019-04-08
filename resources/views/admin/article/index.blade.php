@extends('admin.layout.main')
@section('title')
Danh sách bài viết
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách tài khoản</h4>
                <form class="forms-sample" action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Tiêu đề</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="title" placeholder="Tiêu đề" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Tên admin</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên admin" name="admin_name_c" value="{{ old('admin_name_c') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputName1">Tên người dùng</label>
                                <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên user" name="user_name_c" value="{{ old('user_name_c') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Loại bài viết</label>
                                <select class="form-control" name="type" id="exampleFormControlSelect2">
                                    <option @if(old('type') == -1) selected @endif value="-1">Mời chọn</option>
                                    <option @if(old('type') == 0) selected @endif value="0">Tin tức</option>
                                    <option @if(old('type') == 1) selected @endif value="1">Luật pháp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect3">Trạng thái</label>
                                <select class="form-control" name="status" id="exampleFormControlSelect3">
                                    <option @if(old('type') == -1) selected @endif value="-1">Mời chọn</option>
                                    <option @if(old('type') == 0) selected @endif value="0">Ngừng hoạt động</option>
                                    <option @if(old('type') == 1) selected @endif value="1">Hoạt động</option>
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
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">Danh sách tài khoản</h4> --}}
                {{--<p class="card-description">--}}
                {{--Add class--}}
                {{--<code>.table-bordered</code>--}}
                {{--</p>--}}
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
                                    Trạng thái
                                </th>
                                <th>
                                    Loại bài viết
                                </th>
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
                                    {{ $v->img }}
                                </td>
                                <td>
                                    {{ $v->title }}
                                </td>
                                <td>
                                    {{ $v->status }}
                                </td>
                                <td>
                                    {{ $v->type }}
                                </td>
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
                                    <a href="{{ route('admin.article.getCreate', ['id' => $v->id]) }}"
                                        class="text-warning"><i class="fa fa-pencil-square-o icon-sm"
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
</div>
@endsection
