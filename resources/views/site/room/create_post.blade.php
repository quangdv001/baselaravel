@extends('site.layouts.main')
@section('content')
<div class="breadcrumb-wrapper">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb breadcrumb-dot">
                <li class="breadcrumb-item"><i class="material-icons">home</i><a href="{{ route('site.home.index') }}"
                        title="Trang chủ">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('site.home.category', $category->slug) }}" title="Title link">{{ $category->name }}</a></li>
            </ol>
        </div>
    </div>
</div>
<div class="section-main">
    <div class="container main-wrapper">
        <h1 class="page-title"><span>Tạo tin mới</a></h1>
        <div class="row">
            <div class="col-sm-9 border-sm-right">
                <div class="detail-post">
                    {{-- create post --}}
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{-- <label>Tiêu đề</label> --}}
                                <input type="text" class="form-control_n title" name="title" placeholder="Tiêu đề"
                                    value="">
                                <input type="hidden" class="form-control_n slug" name="slug" placeholder="Slug"
                                    value="">
                                @if($errors->has('title'))
                                <p class="text-danger">{{ $errors->first('title') }}</p>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Slug</label> 
                                <input type="text" class="form-control_n slug" name="slug" placeholder="Slug"
                                    value="">
                                @if($errors->has('slug'))
                                <p class="text-danger">{{ $errors->first('slug') }}</p>
                                @endif
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-12"><div class="form-group">
                                <label for="tag">TAG</label>
                                <input type="text" name="tag" class="form-control_n form-control_n-lg" id="tag"
                                    placeholder="tag" value="{{ $listTag ? $listTag : old('tag') }}">
                            </div> <div class="form-group">
                                <label for="exampleTextarea1">Meta</label>
                                <textarea class="form-control_n" name="meta" id="exampleTextarea1"
                                    rows="2">{{ isset($data->meta) ? $data->meta : old('meta') }}</textarea>
                            </div> 
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Trạng thái</label>
                                <select class="form-control_n" name="status" id="exampleFormControlSelect2">
                                    <option value="1">Hoạt động</option>
                                    <option value="0" @if(isset($data->status) && $data->status == 0) selected
                                        @endif>Ngừng hoạt
                                        động</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Chọn danh mục</label>
                                <select class="form-control_n" name="category_id" id="exampleFormControlSelect2">
                                    {!! $html !!}
                                </select>
                                @if($errors->has('category_id'))
                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                {{-- <label>Giá</label> --}}
                                <input type="text" class="form-control_n price" name="price" placeholder="Giá"
                                    value="">
                                    @if($errors->has('price'))
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{-- <label>Diện tích</label> --}}
                                <input type="text" class="form-control_n acreage" name="acreage" placeholder="Diện tích"
                                    value="">
                                    @if($errors->has('acreage'))
                                <p class="text-danger">{{ $errors->first('acreage') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{-- <label>Loại</label> --}}
                                <input type="text" class="form-control_n type_name" name="type_name" placeholder="Loại"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {{-- <label>Hướng</label> --}}
                                <input type="text" class="form-control_n direction" name="direction" placeholder="Hướng"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chọn Tỉnh/Thành phố</label>
                                <input type="hidden" class="province" value="0">
                                <select class="form-control_n province_id select2" name="province_id">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chọn Quận/Huyện</label>
                                <input type="hidden" class="district" value="0">
                                <select class="form-control_n district_id select2" name="district_id">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Chọn Phường xã</label>
                                <input type="hidden" class="ward" value="0">
                                <select class="form-control_n ward_id select2" name="ward_id">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control_n address" name="address" placeholder="Địa chỉ"
                                    value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="hidden" name="img" class="img"
                                    value="">
                                <br>
                                <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                {{-- <div class="bl-img-show mt-4">
                                    <img src="{{ isset($data->img) ? $data->img : old('img') }}" class="img-show"
                                        width="90" height="90" alt="">
                                </div> --}}
                            </div>
                        </div>

                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="editor1">Mô tả ngắn</label>
                                @if($errors->has('short_description'))
                                <p class="text-danger">{{ $errors->first('short_description') }}</p>
                                @endif
                                <textarea class="form-control_n ckeditor" name="short_description" id="editor1"
                                    rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả</label>
                                @if($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                @endif
                                <textarea class="form-control_n ckeditor" name="description" id="editor2"
                                    rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-success btn-raised  mr-2 has-spinner">Tạo mới</button>
                    <a href="{{ route('admin.article.getList') }}" class="btn btn-raised  btn-light">Hủy</a>
                    {{-- end create post --}}
                </div>
            </div>
            <div class="col-sm-3 sidebar">
                @include('site.layouts.sidebar')
            </div> <!-- sidebar -->
        </div>
    </div>
</div>
@endsection
@section('stylesheets')  
<style>
.form-control_n {
    width: 100%;
    border:none;
    border: 1px solid #eaeaea;
    border-radius: 3px;
    line-height: 30px;
    padding: 0 15px;

}
.select2-hidden-accessible {
    display:none;
}
/* .select2.select2-container {
    display: block;
    width: 100% !important;
    border: 1px solid #eaeaea;
    border-radius: 3px;
    line-height: 30px;
    padding: 0 15px;
} */
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">  
<script>
    var $ = {}; $.noty = {};
    </script>
@endsection
@section('scripts')
<style>
.modal {
    z-index: 9999; 
}
</style>
<script src="{{ asset('assets/admin/js/location.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="{{ asset('assets/admin/js/init.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script>
    $(document).ready(function () {
        // $('#tag').selectize({
        //     plugins: ['remove_button'],
        //     delimiter: ',',
        //     persist: false,
        //     create: function (input) {
        //         return {
        //             value: input,
        //             text: input
        //         }
        //     }
        // });
        $('.select2').select2({
            placeholder: 'Mời chọn'
        });
        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        $(document).on('click', '.btn-select-file-path', function () {
            init.openFileModal(callbackFile);
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

</script>
@endsection
