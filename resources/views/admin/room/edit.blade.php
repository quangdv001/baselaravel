@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật cho thuê' : 'Tạo cho thuê' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Cho thuê</li>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tiêu đề</label>
                                        <input type="text" class="form-control title" name="title" placeholder="Tiêu đề"
                                            value="{{ isset($data->title) ? $data->title : old('title') }}">
                                        @if($errors->has('title'))
                                        <p class="text-danger">{{ $errors->first('title') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Loại</label>
                                        <input type="text" class="form-control type" name="type_name" placeholder="Loại"
                                            value="{{ isset($data->type_name) ? $data->type_name : old('type_name') }}">
                                        @if($errors->has('type_name'))
                                        <p class="text-danger">{{ $errors->first('type_name') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Diện tích</label>
                                        <input type="number" class="form-control acreage" name="acreage" placeholder="Loại"
                                            value="{{ isset($data->acreage) ? $data->acreage : old('acreage') }}">
                                        @if($errors->has('acreage'))
                                        <p class="text-danger">{{ $errors->first('acreage') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hướng</label>
                                        <input type="text" class="form-control direction" name="direction" placeholder="Hướng"
                                            value="{{ isset($data->direction) ? $data->direction : old('direction') }}">
                                        @if($errors->has('direction'))
                                        <p class="text-danger">{{ $errors->first('direction') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input type="number" class="form-control price" name="price" placeholder="Giá"
                                            value="{{ isset($data->price) ? $data->price : old('price') }}">
                                        @if($errors->has('price'))
                                        <p class="text-danger">{{ $errors->first('price') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control title" name="address" placeholder="Địa chỉ"
                                            value="{{ isset($data->address) ? $data->address : old('address') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Chọn Tỉnh/Thành phố</label>
                                        <input type="hidden" class="province" value="{{ isset($data->province_id) ? $data->province_id : 0 }}">
                                        <select class="form-control province_id select2" name="province_id">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Chọn Quận/Huyện</label>
                                        <input type="hidden" class="district" value="{{ isset($data->district_id) ? $data->district_id : 0 }}">
                                        <select class="form-control district_id select2" name="district_id">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Chọn Phường xã</label>
                                        <input type="hidden" class="ward" value="{{ isset($data->ward_id) ? $data->ward_id : 0 }}">
                                        <select class="form-control ward_id select2" name="ward_id">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                
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
                                                    <img src="{{ $v->img }}" width="90" height="90" alt="">
                                                    <input type="hidden" name="article_img[]" class="article_img"
                                                        value="{{ $v->img }}">
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">

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
                                            rows="10">{{ isset($data->description) ? $data->description : old('description') }}</textarea>
                                    </div>
                                </div>


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
@section('lib_js')
<script src="{{ asset('public/assets/admin/js/location.js') }}"></script>
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
        $('.select2').select2({
            placeholder: 'Mời chọn'
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

</script>
@endsection
