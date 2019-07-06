@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật trang' : 'Tạo trang' }}
@endsection
@section('content')
<form class="forms-sample" action="" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin trang</h4>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text" class="form-control title" name="title" placeholder="Tiêu đề"
                            value="{{ isset($data->title) ? $data->title : old('title') }}">
                        @if($errors->has('title'))
                        <p class="text-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control slug" name="slug" placeholder="Slug"
                            value="{{ isset($data->slug) ? $data->slug : old('slug') }}">
                        @if($errors->has('slug'))
                        <p class="text-danger">{{ $errors->first('slug') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Meta</label>
                        <textarea class="form-control" name="meta" id="exampleTextarea1"
                            rows="2">{{ isset($data->meta) ? $data->meta : old('meta') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="editor2">Nội dung trang</label>
                        <br>
                        <a href="javascript:void(0)" class="btn btn-info btn-append-img">Chèn ảnh</a>
                        <textarea class="form-control ckeditor" name="content" id="editor2"
                            rows="5">{{ isset($data->content) ? $data->content : old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Trạng thái</label>
                        <select class="form-control" name="status" id="exampleFormControlSelect2">
                            <option value="1">Hoạt động</option>
                            <option value="0" @if(isset($data->status) && $data->status == 0) selected @endif>Ngừng hoạt
                                động</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="btn btn-success mr-2 has-spinner">{{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                    <a href="{{ route('admin.manager.getList') }}" class="btn btn-light">Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
        $('#tag').selectize({
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            create: function (input) {
                return {
                    value: input,
                    text: input
                }
            }
        });

        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        $(document).on('click', '.btn-select-file-path', function () {
            init.openFileModal(callbackFile);
        });

        $(document).on('click', '.btn-append-img', function () {
            init.openFileModal(callbackCkeditor);
        });

        $('.title').keyup(function () {
            var val = $(this).val();
            var slug = init.makeSlug(val);
            $('.slug').val(slug);
        })
    });
    var callback = function (data) {
        $('.img').val(data.url);
        $('.img-show').attr('src', data.url);
    }
    var callbackFile = function (data) {
        $('.file_path').val(data.path);
    }

    var callbackCkeditor = function (data) {
        img = "<img src='"+ data.url +"'/>";
        CKEDITOR.instances.editor2.insertHtml(img);
    }

</script>
@endsection
