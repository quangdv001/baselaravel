@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật Album ảnh' : 'Tạo Album ảnh' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Album ảnhr</li>
</ol>

<form class="forms-sample" action="" method="post">
    @csrf
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Album ảnh</strong></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nội dung tiếng việt</label>
                                <input type="text" class="form-control title" name="content_vi" placeholder="Tiêu đề"
                                    value="{{ isset($data->content_vi) ? $data->content_vi : old('content_vi') }}">
                                @if($errors->has('content_vi'))
                                <p class="text-danger">{{ $errors->first('content_vi') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nội dung tiếng anh</label>
                                <input type="text" class="form-control title" name="content_en" placeholder="Tiêu đề"
                                    value="{{ isset($data->content_en) ? $data->content_en : old('content_en') }}">
                                @if($errors->has('content_en'))
                                <p class="text-danger">{{ $errors->first('content_en') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ảnh Nền</label>
                                        <input type="hidden" name="image" class="img"
                                            value="{{isset($data->image) ? $data->image : old('image')}}">
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                        <div class="bl-img-show mt-4">
                                            <img src="{{ isset($data->image) ? $data->image : old('image') }}"
                                                class="img-show" width="90" height="90" alt="">
                                        </div>
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

        $('.removeImgInside').click(function (){
            $('.img-inside').val('');
            $('.img-show-inside').attr('src', "{{ asset('public/assets/site/themes/assets/images/slide-img.png') }}");
        })

        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        $(document).on('click', '.btn-select-file-inside', function () {
            init.openFileModal(callbackImgInside);
        });


        $(document).on('click', '.btn-append-img', function () {
            init.openFileModal(callbackCkeditor);
        });

        $('.title').keyup(function () {
            var val = $(this).val();
            var slug = init.makeSlug(val);
            $('.slug').val(slug);
        })

        $(document).on('click', '.btn-rm-img-item', function () {
            $(this).parent().remove();
        })
    });
    var callback = function (data) {
        $('.img').val(data.url);
        $('.img-show').attr('src', data.url);
    }

    var callbackImgInside = function (data) {
        $('.img-inside').val(data.url);
        $('.img-show-inside').attr('src', data.url);
    }

    var callbackCkeditor = function (data) {
        img = "<img src='" + data.url + "'/>";
        CKEDITOR.instances.editor2.insertHtml(img);
    }

    var callbackMultiple = function (data) {
        html = '';
        if (data.length > 0) {
            data.forEach(function (value, index) {
                html +=
                    '<li class="list-inline-item mb-2 position-relative"><a href="javascript:void(0)" class="btn-rm-img-item position-absolute" style="right: 0"><i class="fa fa-times text-danger" aria-hidden="true"></i></a><img src="' +
                    value +
                    '" width="90" height="90" alt=""><input type="hidden" name="article_img[]" class="article_img" value="' +
                    value + '"></li>'
            })
        }
        $('.list-img-article').append(html);
    }

</script>
@endsection
