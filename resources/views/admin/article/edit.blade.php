@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật bài viết' : 'Tạo bài viết' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>

<form class="forms-sample" action="" method="post">
    @csrf
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    @if(sizeof($listLocales) > 0)
                    <ul class="nav nav-tabs">
                        @foreach($listLocales as $v)
                            <li class="nav-item">
                                <a class="nav-link  @if($locale == $v) active @endif" href="{{ route('admin.article.getCreate', ['locale' => $v, 'id' => $id]) }}">{{ $v }}</a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <strong>Thông tin cơ bản</strong></div>
                        <div class="card-body">
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
                                <label for="tag">TAG</label>
                                <input type="text" name="tag" class="" id="tag" placeholder="tag"
                                    value="{{ $listTag ? $listTag : old('tag') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Meta</label>
                                <textarea class="form-control" name="meta" id="exampleTextarea1"
                                    rows="2">{{ isset($data->meta) ? $data->meta : old('meta') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Chọn danh mục</label>
                                <select class="form-control" name="category_id" id="exampleFormControlSelect2">
                                    <option value="0">Mời chọn</option>
                                    {!! $html !!}
                                </select>
                                @if($errors->has('category_id'))
                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ảnh</label>
                                        <input type="hidden" name="img" class="img"
                                            value="{{isset($data->img) ? $data->img : old('img')}}">
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                        <div class="bl-img-show mt-4">
                                            <img src="{{ isset($data->img) ? $data->img : old('img') }}"
                                                class="img-show" width="90" height="90" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Ảnh thêm</label>
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-info btn-select-multi-file">Chọn
                                            ảnh</a>
                                        <div class="bl-img-show mt-4">
                                            <ul class="list-inline list-img-article">
                                                @if(sizeof($articleImg) > 0)
                                                @foreach($articleImg as $v)
                                                <li class="list-inline-item mb-2 position-relative">
                                                    <a href="javascript:void(0)"
                                                        class="btn-rm-img-item position-absolute" style="right: 0"><i
                                                            class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                    <img src="{{ $v }}" width="90" height="90" alt="">
                                                    <input type="hidden" name="article_img[]" class="article_img"
                                                        value="{{ $v }}">
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor1">Mô tả ngắn</label>
                                <textarea class="form-control ckeditor" name="short_description" id="editor1"
                                    rows="2">{{ isset($data->short_description) ? $data->short_description : old('short_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả</label>
                                <br>
                                <a href="javascript:void(0)" class="btn btn-info btn-append-img">Chèn ảnh</a>
                                <textarea class="form-control ckeditor" name="description" id="editor2"
                                    rows="5">{{ isset($data->description) ? $data->description : old('description') }}</textarea>
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

        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        $(document).on('click', '.btn-select-multi-file', function () {
            init.openFileModal(callbackMultiple, true);
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
