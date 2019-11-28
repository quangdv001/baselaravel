@extends('admin.layout.main')
@section('title')
Danh sách danh mục
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
    <!-- Breadcrumb Menu-->
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="#">
                <i class="icon-speech"></i>
            </a>
            <a class="btn" href="./">
                <i class="icon-graph"></i>  Dashboard</a>
            <a class="btn" href="#">
                <i class="icon-settings"></i>  Settings</a>
        </div>
    </li>
</ol>

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="float-left">Danh sách danh mục</strong>
                        <div class="float-right"><button type="button"
                                class="btn btn-sm btn-primary btn-add-category">Tạo
                                danh mục</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="cf nestable-lists">
                            <div class="dd" id="nestable">
                                {!! $html !!}
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary btn-save" type="button">
                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bl-form" style="display:none;">
                    <div class="card-header">
                        <strong>Chi tiết danh mục - <span class="category-id">0</span></strong> </div>
                    <div class="card-body">
                        <input type="hidden" name="id" class="id" value="0">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Tên danh mục</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control name" name="name" placeholder="Tên danh mục"
                                    value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">URL</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control url" name="url" placeholder="URL" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Mô tả</label>
                            <div class="col-md-9">
                                <textarea class="form-control description" name="description" id="exampleTextarea1"
                                    rows="2"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="select1">Loại</label>
                            <div class="col-md-9">
                                <select class="form-control type" id="exampleFormControlSelect3">
                                    @foreach($arrType as $k => $v) 
                                    <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="select1">Trạng thái</label>
                            <div class="col-md-9">
                                <select class="form-control status" id="exampleFormControlSelect2">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Ngừng hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="select1">Ảnh</label>
                            <div class="col-md-9">
                                <input type="hidden" name="img" class="img" value="">
                                <br>
                                <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                <div class="bl-img-show mt-4">
                                    <img src="" class="img-show" width="90" height="90" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-sm btn-primary has-spinner btn-update" type="button">
                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                        {{-- <button class="btn btn-sm btn-danger" type="reset">
                                <i class="fa fa-ban"></i> Reset</button> --}}
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
        // $('.bl-form').hide();
        $('.file-upload-browse').click(function () {
            $('.file-upload-default').trigger('click');
        });
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
        // activate Nestable for list 1
        $('#nestable').nestable({
                group: 1
            })
            .on('change', updateOutput);

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
        $('.btn-add-category').click(function () {
            var url = BASE_URL + '/admin/category/create';
            $.post(url, function (res) {
                console.log(res);
                if (res.success == 1) {
                    // var newCategory = '<li class="dd-item dd3-item" data-id="'+ res.data.id +'">'+
                    //             '<div class="dd-handle dd3-handle"></div>'+
                    //             '<div class="dd3-content">'+
                    //                 '<div class="pull-left">'+
                    //                     '<span class="text-category">'+ res.data.id + '-' + res.data.name +'</span>'+
                    //                 '</div>'+
                    //                 '<div class="pull-right">'+
                    //                     '<a href="javascript:void(0);" class="text-warning mr-2 btn-edit" data-id="'+ res.data.id +'"><i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i></a>'+
                    //                     '<a href="javascript:void(0);" class="text-danger rm_group_btn btn-rm" data-id="'+ res.data.id +'"><i class="fa fa-trash icon-sm" aria-hidden="true"></i></a>'+
                    //                 '</div>'+
                    //             '</div>'+
                    //         '</li>';

                    // $('.dd-list').closest('#nestable').append(newCategory);
                    $('.dd-list').closest('#nestable').html(res.html);
                    $('.id').val(res.data.id);
                    $('.category-id').text(res.data.id);
                    $('.name').val(res.data.name);
                    $('.bl-form').show();
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        });

        $('.btn-update').click(function () {
            var id = $('.id').val();
            var name = $('.name').val();
            // var slug = $('.slug').val();
            var img = $('.img').val();
            var description = $('.description').val();
            var status = $('.status').val();
            var type = $('.type').val();
            var urll = $('.url').val();
            var class_name = $('.class_name').val();
            var url = BASE_URL + '/admin/category/update/' + id;
            var data = {
                id: id,
                name: name,
                img: img,
                description: description,
                status: status,
                type: type,
                url: urll,
                // slug: slug,
                class_name: class_name,
            };
            var obj = $(this);
            obj.buttonLoader('start');
            $.post(url, data, function (res) {
                obj.buttonLoader('stop');
                if (res.success == 1) {
                    init.notyPopup(res.mess, 'success');
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        });

        $(document).on('click', '.btn-edit', function (e) {
            $('.dd3-content').removeClass('active');
            $(this).parent().parent().addClass('active');
            var obj = $('.bl-form');
            var id = $(this).data('id');
            var url = BASE_URL + '/admin/category/' + id;
            init.showLoader(obj);
            $.get(url, function (res) {
                init.hideLoader(obj);
                if (res.success == 1) {
                    $('.id').val(res.data.id);
                    $('.category-id').text(res.data.id);
                    $('.name').val(res.data.name);
                    $('.img').val(res.data.img);
                    $('.img-show').attr('src', res.data.img);
                    $('.url').val(res.data.url);
                    // $('.slug').val(res.data.slug);
                    $('.description').val(res.data.description);
                    $('.status').val(res.data.status);
                    $('.type').val(res.data.type);
                    $('.bl-form').show();
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        });

        $(document).on('click', '.btn-rm', function (e) {
            if (confirm('Bạn có chắc muốn xóa danh mục này?')) {
                var id = $(this).data('id');
                var url = BASE_URL + '/admin/category/remove/' + id;
                var obj = $(this);
                $.get(url, function (res) {
                    if (res.success == 1) {
                        obj.parent().parent().parent().remove();
                        init.notyPopup(res.mess, 'success');
                    } else {
                        init.notyPopup(res.mess, 'error');
                    }
                });
            }
        });

        $('.btn-save').click(function () {
            var serialize = $('.dd').nestable('serialize');
            var url = BASE_URL + '/admin/category/updatePosition';
            var data = {
                data: serialize
            };
            $.post(url, data, function (res) {
                if (res.success == 1) {
                    init.notyPopup(res.mess, 'success');
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        })

        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        // $('.name').keyup(function () {
        //     var val = $(this).val();
        //     var slug = init.makeSlug(val);
        //     $('.slug').val(slug);
        // })
    });
    var callback = function (data) {
        $('.img').val(data.url);
        $('.img-show').attr('src', data.url);
    }

</script>
@endsection
