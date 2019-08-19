@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật phòng trọ' : 'Tạo phòng trọ' }}
@endsection
@section('content')
<form class="forms-sample" action="" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin cơ bản</h4>
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
                                <label>Slug</label>
                                <input type="text" class="form-control slug" name="slug" placeholder="Slug"
                                    value="{{ isset($data->slug) ? $data->slug : old('slug') }}">
                                @if($errors->has('slug'))
                                <p class="text-danger">{{ $errors->first('slug') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tag">TAG</label>
                                <input type="text" name="tag" class="form-control form-control-lg" id="tag"
                                    placeholder="tag" value="{{ $listTag ? $listTag : old('tag') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea1">Meta</label>
                                <textarea class="form-control" name="meta" id="exampleTextarea1"
                                    rows="2">{{ isset($data->meta) ? $data->meta : old('meta') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Trạng thái</label>
                                <select class="form-control" name="status" id="exampleFormControlSelect2">
                                    <option value="1">Hoạt động</option>
                                    <option value="0" @if(isset($data->status) && $data->status == 0) selected
                                        @endif>Ngừng hoạt
                                        động</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Chọn danh mục</label>
                                <select class="form-control" name="category_id" id="exampleFormControlSelect2">
                                    {!! $html !!}
                                </select>
                                @if($errors->has('category_id'))
                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control price" name="price" placeholder="Giá"
                                    value="{{ isset($data->price) ? $data->price : old('price') }}">
                                    @if($errors->has('price'))
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Diện tích</label>
                                <input type="text" class="form-control acreage" name="acreage" placeholder="Diện tích"
                                    value="{{ isset($data->acreage) ? $data->acreage : old('acreage') }}">
                                    @if($errors->has('acreage'))
                                <p class="text-danger">{{ $errors->first('acreage') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Loại</label>
                                <input type="text" class="form-control type_name" name="type_name" placeholder="Loại"
                                    value="{{ isset($data->type_name) ? $data->type_name : old('type_name') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Hướng</label>
                                <input type="text" class="form-control direction" name="direction" placeholder="Hướng"
                                    value="{{ isset($data->direction) ? $data->direction : old('direction') }}">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control title" name="address" placeholder="Địa chỉ"
                                    value="{{ isset($data->address) ? $data->address : old('address') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input type="hidden" name="img" class="img"
                                    value="{{isset($data->img) ? $data->img : old('img')}}">
                                <br>
                                <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                <div class="bl-img-show mt-4">
                                    <img src="{{ isset($data->img) ? $data->img : old('img') }}" class="img-show"
                                        width="90" height="90" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="editor1">Mô tả ngắn</label>
                                @if($errors->has('short_description'))
                                <p class="text-danger">{{ $errors->first('short_description') }}</p>
                                @endif
                                <textarea class="form-control ckeditor" name="short_description" id="editor1"
                                    rows="2">{{ isset($data->short_description) ? $data->short_description : old('short_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="editor2">Mô tả</label>
                                @if($errors->has('description'))
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                @endif
                                <textarea class="form-control ckeditor" name="description" id="editor2"
                                    rows="5">{{ isset($data->description) ? $data->description : old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="btn btn-success mr-2 has-spinner">{{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                    <a href="{{ route('admin.article.getList') }}" class="btn btn-light">Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('lib_js')
<script src="{{ asset('assets/admin/js/location.js') }}"></script>
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
