@extends('admin.layout.main')
@section('title')
    {{ $id > 0 ? 'Cập nhật bài viết' : 'Tạo bài viết' }}
@endsection
@section('content')
    <form class="forms-sample" action="" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thông tin cơ bản</h4>
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-control" name="title" placeholder="Tiêu đề" value="{{ isset($data->title) ? $data->title : old('title') }}">
                            @if($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" name="slug" placeholder="Slug" value="{{ isset($data->slug) ? $data->slug : old('slug') }}">
                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea1">Meta</label>
                            <textarea class="form-control" name="meta" id="exampleTextarea1" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea2">Mô tả ngắn</label>
                            <textarea class="form-control" name="short_description" id="exampleTextarea2" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleTextarea3">Mô tả</label>
                            <textarea class="form-control" name="description" id="exampleTextarea3" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Loại bài viết</label>
                            <select class="form-control" name="type" id="exampleFormControlSelect2">
                                <option value="0" @if(isset($data->status) && $data->status == 0) selected @endif>Tin tức</option>
                                <option value="1" @if(isset($data->status) && $data->status == 1) selected @endif>Luật pháp</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Trạng thái</label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option value="1">Hoạt động</option>
                                <option value="0" @if(isset($data->status) && $data->status == 0) selected @endif>Ngừng hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success mr-2 has-spinner">{{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                        <a href="{{ route('admin.article.getList') }}" class="btn btn-light">Hủy</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('custom_js')
    <script>
        $(document).ready(function(){
            //
        })
    </script>
@endsection