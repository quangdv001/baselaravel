@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật sản phẩm' : 'Tạo sản phẩm' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    {{-- <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li> --}}
    <li class="breadcrumb-item active">Product</li>
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
                                <label for="exampleFormControlSelect2">Loại sản phẩm</label>
                                <select class="form-control is_combo" name="is_combo" >
                                    <option value="0">Thường</option>
                                    <option value="1" @if(isset($data->status) && $data->status == 1) selected
                                        @endif>Combo</option>
                                </select>
                            </div>
                            <div class="form-group group_product_combo">
                                <label for="exampleFormControlSelect2">Sản phẩm combo</label>
                                <select class="form-control product_combo" name="product_combo[]"  multiple="multiple">
                                    @if(sizeof($productCombo) > 0)
                                        @foreach($productCombo as $v)
                                            <option value="{{ $v->id }}" @if(in_array($v->id, $arrProductCombo)) selected @endif>#{{ $v->id }} - {{ $v->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="row">
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
                                        <label for="exampleFormControlSelect2">Loại</label>
                                        <select class="form-control" name="type" id="exampleFormControlSelect2">
                                            <option value="0" @if(isset($data->type) && $data->type == 0) selected
                                                    @endif>chiếc</option>
                                            <option value="1" @if(isset($data->type) && $data->type == 1) selected
                                                    @endif>md</option>
                                            <option value="2" @if(isset($data->type) && $data->type == 2) selected
                                                @endif>m2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                        <label>Giá</label>
                                        <input type="number" class="form-control price" name="price" placeholder="Giá"
                                            maxlength="10"
                                            value="{{ isset($data->price) ? $data->price : old('price') }}">
                                        @if($errors->has('price'))
                                        <p class="text-danger">{{ $errors->first('price') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Màu sắc</label>
                                        <input type="text" class="form-control color" name="color" placeholder="Màu sắc"
                                            value="{{ isset($data->color) ? $data->color : old('color') }}">
                                        @if($errors->has('color'))
                                        <p class="text-danger">{{ $errors->first('color') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chất liệu</label>
                                        <input type="text" class="form-control material" name="material"
                                            placeholder="Vật liệu"
                                            value="{{ isset($data->material) ? $data->material : old('material') }}">
                                        @if($errors->has('material'))
                                        <p class="text-danger">{{ $errors->first('material') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bảo hành</label>
                                        <input type="text" class="form-control guarantee" name="guarantee"
                                            placeholder="Bảo hành"
                                            value="{{ isset($data->guarantee) ? $data->guarantee : old('guarantee') }}">
                                        @if($errors->has('guarantee'))
                                        <p class="text-danger">{{ $errors->first('guarantee') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Phong cách</label>
                                        <input type="text" class="form-control style" name="style"
                                            placeholder="Phong cách"
                                            value="{{ isset($data->style) ? $data->style : old('style') }}">
                                        @if($errors->has('style'))
                                        <p class="text-danger">{{ $errors->first('style') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Kích thước</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                    <input type="number" class="form-control width" name="width"
                                                    placeholder="Dài"
                                                    value="{{ isset($data->width) ? $data->width : old('width') }}">
                                            </div>
                                            <div class="col-md-4">
                                                    <input type="number" class="form-control depth" name="depth"
                                                    placeholder="Rộng"
                                                    value="{{ isset($data->depth) ? $data->depth : old('depth') }}">
                                            </div>
                                            <div class="col-md-4">
                                                    <input type="number" class="form-control height" name="height"
                                                    placeholder="Cao"
                                                    value="{{ isset($data->height) ? $data->height : old('height') }}">
                                            </div>
                                        </div>
                                        
                                        
                                        
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Loại vật liệu</label>
                                        <select class="form-control" name="material_id" id="exampleFormControlSelect2">
                                                <option value="0">Mời chọn</option>
                                            @if(sizeof($material) > 0)
                                            @foreach($material as $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div> --}}
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Ảnh đại diện</label>
                                        <input type="hidden" name="img" class="img"
                                            value="{{isset($data->img) ? $data->img : old('img')}}">
                                        <br>
                                        <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn
                                            ảnh</a>
                                        <div class="bl-img-show mt-4">
                                            <img src="{{ isset($data->img) ? $data->img : old('img') }}"
                                                class="img-show" width="90" height="90" alt="">
                                        </div>
                                        @if($errors->has('img'))
                                        <p class="text-danger">{{ $errors->first('img') }}</p>
                                        @endif
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
                                                @if(sizeof($productImg) > 0)
                                                @foreach($productImg as $v)
                                                <li class="list-inline-item mb-2 position-relative">
                                                    <a href="javascript:void(0)"
                                                        class="btn-rm-img-item position-absolute"
                                                        style="right: 0"><i class="fa fa-times text-danger"
                                                            aria-hidden="true"></i></a>
                                                    <img src="{{ $v }}" width="90" height="90" alt="">
                                                    <input type="hidden" name="product_img[]" class="product_img"
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
                                <label for="editor2">Mô tả</label>
                                <br>
                                <a href="javascript:void(0)" class="btn btn-info btn-append-img">Chèn ảnh</a>
                                <textarea class="form-control ckeditor" name="description" id="editor2"
                                    rows="5">{{ isset($data->description) ? $data->description : old('description') }}</textarea>
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

        if($('.is_combo').val() == 1){
            $('.group_product_combo').slideDown();
        } else {
            $('.group_product_combo').slideUp();
        }

        $('.is_combo').change(function(){
            if($(this).val() == 1){
                $('.group_product_combo').slideDown();
            } else {
                $('.group_product_combo').slideUp();
            }
        })

        $('.product_combo').select2({
            placeholder: 'Select an option',
            // tags: true
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
            console.log(1);
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
            console.log(data);
            data.forEach(function (value, index) {
                html +=
                    '<li class="list-inline-item mb-2 position-relative"><a href="javascript:void(0)" class="btn-rm-img-item position-absolute" style="right: 0"><i class="fa fa-times text-danger" aria-hidden="true"></i></a><img src="' +
                    value +
                    '" width="90" height="90" alt=""><input type="hidden" name="product_img[]" class="product_img" value="' +
                    value + '"></li>'
            })
        }
        $('.list-img-article').append(html);
    }

</script>
@endsection
