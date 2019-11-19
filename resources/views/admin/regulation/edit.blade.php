@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật quy định' : 'Tạo quy định' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
    <a href="{{ route('admin.regulation.getList') }}">Quy định</a>
    </li>
<li class="breadcrumb-item active">{{ $id > 0 ? 'Sửa' : 'Tạo' }}</li>
</ol>

<form class="forms-sample" action="" method="post">
    @csrf
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Quy định</strong></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control title" name="name" placeholder="Tiêu đề"
                                    value="{{ isset($data->name) ? $data->name : old('content_vi') }}">
                                @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="hidden" name="file_id" class="img"
                                            value="{{isset($data->file_id) ? $data->file_id : old('file_id')}}">
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                        <a class="file_name @if(!isset($data->file_id)) d-none @endif" target="_blank" href="{{ isset($data->file_id) ? $data->file->url : 'javascript:void(0)' }}">Tải thử file</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Trạng thái</label>
                                <select class="form-control" name="status" id="exampleFormControlSelect2">
                                    <option value="1">Hoạt động</option>
                                    <option value="0" @if(isset($data->status) && $data->status == 0) selected
                                        @endif>Ngừng
                                        hoạt
                                        động</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary has-spinner" type="submit">
                                <i class="fa fa-dot-circle-o"></i> {{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                            <button class="btn btn-sm btn-danger" type="reset">
                                <i class="fa fa-ban"></i> Reset</button>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
        </div>
    </div>
</form>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {

        $('.removeImgInside').click(function (){
            $('.img-inside').val('');
            $('.img-show-inside').attr('src', "{{ asset('public/assets/site/themes/assets/images/slide-img.png') }}");
        })

        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        
    });
    var callback = function (data) {
        $('.img').val(data.id);
        $('.file_name').attr('href', data.url);
        $('.file_name').removeClass('d-none');
    }


</script>
@endsection
