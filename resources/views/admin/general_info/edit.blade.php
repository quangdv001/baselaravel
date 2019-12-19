@extends('admin.layout.main')
@section('title')
    {{ $id > 0 ? 'Cập nhật thông tin chung' : 'Thêm thông tin chung' }}
@endsection
@inject('Service', 'App\Services\GeneralInfoService' )
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">General Info</li>
    </ol>

    <form class="forms-sample" action="" method="post">
        @csrf
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Thông tin cơ bản</strong></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tiêu đề</label>
                                            <input type="text" class="form-control title" name="name"
                                                   placeholder="Tiêu đề"
                                                   value="{{ isset($data->name) ? $data->name : old('name') }}">
                                            @if($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select class="form-control" name="status">
                                                <option value="{{$Service::STATUS_ACTIVE}}">Hoạt động</option>
                                                <option value="{{$Service::STATUS_NOT_ACTIVE}}"
                                                        @if(isset($data->status) && $data->status == $Service::STATUS_NOT_ACTIVE) selected
                                                    @endif>Ngừng hoạt động
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    @if(!in_array((isset($data->type)?$data->type:-1),array_keys($arrTypeOnly)) )
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Loại</label>
                                            <select class="form-control" name="type">
                                                @foreach($arrType as $k => $type)
                                                    <option {{ (isset($data->type) && $data->type == $k)?'selected':'' }} value="{{$k}}">{{$type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div
                                        class="col-md-4 image" {{isset($data->type)?(in_array($data->type,[$Service::TYPE_LOGO,$Service::TYPE_CERTIFICATE_IMAGE])?'':'style=display:none'):''}}>
                                        <div class="form-group">
                                            <label>Ảnh</label>
                                            <a href="javascript:void(0)"
                                               class="d-block text-center btn btn-info btn-select-file">
                                                Chọn ảnh <i class="mdi mdi-upload icon-picture"></i>
                                            </a>
                                            @if($errors->has('img'))
                                                <p class="text-danger">{{ $errors->first('img') }}</p>
                                            @endif
                                            <input type="hidden" name="img" class="img"
                                                   value="{{ isset($data->img) ? $data->img : old('img') }}">
                                            <div class="bl-img-show mt-4">
                                                <img src="{{ isset($data->img) ? $data->img : old('img') }}"
                                                     class="img-show" width="100%" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-4 social" {{(isset($data->type) && $data->type == $Service::TYPE_SOCIAL)?'':'style=display:none'}}>
                                        <div class="form-group">
                                            <label>Link Social</label>
                                            <input type="text" class="form-control title" name="link"
                                                   placeholder="Link Social"
                                                   value="{{ isset($data->link) ? $data->link : old('link') }}">
                                            @if($errors->has('link'))
                                                <p class="text-danger">{{ $errors->first('link') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-4 social" {{(isset($data->type) && $data->type == $Service::TYPE_SOCIAL)?'':'style=display:none'}}>
                                        <div class="form-group">
                                            <label>Icon Social</label>
                                            <input type="text" class="form-control title" name="icon"
                                                   placeholder="Icon Social"
                                                   value="{{ isset($data->icon) ? $data->icon : old('icon') }}">
                                            @if($errors->has('icon'))
                                                <p class="text-danger">{{ $errors->first('icon') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div
                                        class="col-md-12 text" {{isset($data->type)?(!in_array($data->type,[$Service::TYPE_LOGO,$Service::TYPE_CERTIFICATE_IMAGE,$Service::TYPE_SOCIAL])?'':''):'style=display:none'}}>
                                        <div class="form-group">
                                            <p>
                                                <label for="editor2">Mô tả</label>
                                                <a href="javascript:void(0)" class="btn btn-info btn-append-img">Chèn
                                                    ảnh</a>
                                            </p>
                                            <textarea class="form-control ckeditor" name="content" id="editor2"
                                                      rows="10">{{ isset($data->content) ? $data->content : old('content') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary has-spinner" type="submit">
                                    <i class="fa fa-dot-circle-o"></i> {{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                                <button class="btn btn-sm btn-danger" type="reset">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
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
                init.openFileModal(callbackCkeditor, true);
            });

            $('.title').keyup(function () {
                var val = $(this).val();
                var slug = init.makeSlug(val);
                $('.slug').val(slug);
            })

            $(document).on('click', '.btn-rm-img-item', function () {
                console.log(1);
                $(this).parent().remove();
            })
        });
        var callback = function (data) {
            $('.img').val(data.url);
            $('.img-show').attr('src', data.url);
        }

        var callbackCkeditor = function (data) {
            html = '';
            console.log(data);
            if (data.length > 0) {
                data.forEach(function (value, index) {
                    html += "<img src='" + value + "'/>";
                })
            }
            CKEDITOR.instances.editor2.insertHtml(html);
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
        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        $('select[name="type"]').change(function () {
            switch ($(this).val()) {
                case '{{$Service::TYPE_SOCIAL}}':
                    $('.social').show();
                    $('.image').hide();
                    $('.text').hide();
                    break;
                case '{{$Service::TYPE_LOGO}}':
                case '{{$Service::TYPE_CERTIFICATE_IMAGE}}':
                    $('.image').show();
                    $('.social').hide();
                    $('.text').hide();
                    break;
                default:
                    $('.social').hide();
                    $('.image').hide();
                    $('.text').show();
                    break;
            }
        })
    </script>
@endsection
