@extends('admin.layout.main')
@section('title')
    Cài đặt chân trang
@endsection
@inject('Service', 'App\Services\SettingFooterService' )
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
                            <strong class="float-left">Cài đặt chân trang</strong>
                            <div class="float-right">
                                <button type="button"
                                        class="btn btn-sm btn-primary btn-add-category-footer">Tạo danh mục
                                </button>
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
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bl-form" style="display:none;">
                        <div class="card-header">
                            <strong>Chi tiết danh mục - <span class="category-id">0</span></strong></div>
                        <div class="card-body">

                            <form action="" id="form-edit">
                                <input type="hidden" name="id" class="id" value="0">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Nội dung danh mục</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control content" name="content"
                                               placeholder="Tên danh mục"
                                               value="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="select1">Trạng thái</label>
                                    <div class="col-md-9">
                                        <select class="form-control status" name="status">
                                            <option value="1">Hoạt động</option>
                                            <option value="0">Ngừng hoạt động</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Loại</label>
                                    <div class="col-md-9">
                                        <select class="form-control type" name="type">
                                            @foreach($arrType as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row pages" style="display:none;">
                                    <label class="col-md-3 col-form-label" for="">Trang nội dung</label>
                                    <div class="col-md-9">
                                        <select class="form-control single_page_id select2" name="single_page_id">
                                            @foreach($listPage as $k => $v)
                                                <option value="{{ $v['id'] }}">{{ $v['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row image" style="display: none">
                                    <label class="col-md-3 col-form-label" for="select1">Ảnh</label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="img" class="img" value="">
                                        <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                                        <div class="bl-img-show mt-4">
                                            <img src="" class="img-show" width="90" height="90" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="social">
                                    <div class="form-group row mb-1">
                                        <div class="col-md-3">
                                            <label class="col-form-label">Social</label>
                                        </div>
                                        <div class="col-md-9">
                                            <a href="javascript:void(0)"
                                               class="btn btn-outline-primary btn-sm btn-add-social">Thêm social</a>
                                        </div>
                                    </div>
                                    <div class="item-social mb-3">
                                        <div class="form-group row mb-1">
                                            <div class="col-md-3">
                                                <label class="col-form-label ml-3">
                                                    Tên Social
                                                </label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="social[]['name']"
                                                       placeholder="Tên social" value="">
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0);"
                                                   class="text-danger  btn-rm-social">
                                                    <i class="fa fa-trash icon-sm" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <div class="col-md-3">
                                                <label class="col-form-label ml-3">Link Social</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="social[]['link']"
                                                       placeholder="Link social" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-1">
                                            <div class="col-md-3">
                                                <label class="col-form-label ml-3">Icon Social</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="social[]['icon']"
                                                       placeholder="Icon social" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary has-spinner btn-update" type="button">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
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
                    $('.btn-save').click();
                    $('.bl-form').hide();
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
            $('.btn-add-category-footer').click(function () {
                var url = BASE_URL + '/admin/setting-footer/create';
                $.post(url, function (res) {
                    console.log(res);
                    if (res.success == 1) {
                        $('.dd-list').closest('#nestable').html(res.html);
                        // $('.id').val(res.data.id);
                        // $('.category-id').text(res.data.id);
                        // $('.name').val(res.data.name);
                        // $('.bl-form').show();
                    } else {
                        init.notyPopup(res.mess, 'error');
                    }
                });
            });

            $('.btn-update').click(function () {
                let dataForm = $('#form-edit').serializeArray();
                let id = $('.id').val();
                let url = BASE_URL + '/admin/setting-footer/update/' + id;
                let obj = $(this);
                obj.buttonLoader('start');
                $.post(url, dataForm, function (res) {
                    obj.buttonLoader('stop');
                    console.log(res);
                    if (res.success === 1) {
                        init.notyPopup(res.mess, 'success');
                    } else {
                        init.notyPopup(res.message, 'error');
                    }
                });
            });

            $(document).on('click', '.btn-edit', function (e) {
                $('.dd3-content').removeClass('active');
                $(this).parent().parent().addClass('active');
                var obj = $('.bl-form');
                var id = $(this).data('id');
                var url = BASE_URL + '/admin/setting-footer/' + id;
                init.showLoader(obj);
                $.get(url, function (res) {
                    init.hideLoader(obj);
                    if (res.success == 1) {
                        $('.id').val(res.data.id);
                        $('.category-id').text(res.data.id);
                        $('.content').val(res.data.content);
                        $('.img').val(res.data.img);
                        $('.img-show').attr('src', res.data.img);
                        $('.status').val(res.data.status);
                        $('.type').val(res.data.type);
                        $('.single_page_id').val(res.data.single_page_id);
                        $('.bl-form').show();
                        console.log(res.data.type);
                        switch (res.data.type) {
                            case {{$Service::TYPE_TEXT}}:
                                break;
                            case {{$Service::TYPE_SINGLE_PAGE}}:
                                $('.pages').show();
                                $('select[name="single_page_id"]').val(res.data.single_page_id);
                                $('select[name="single_page_id"] option').each(function (i) {
                                    if ($(this).attr('value') == res.data.single_page_id) {
                                        $(this).prop("selected", true);
                                    }
                                    else {
                                        $(this).prop("selected", false);
                                    }
                                });
                                break;
                            case {{$Service::TYPE_SOCIAL}}:

                                break;
                            case {{$Service::TYPE_IMAGE}}:
                                $('.image').show();
                                break;
                        }
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
                console.log(serialize);
                var url = BASE_URL + '/admin/setting-footer/updatePosition';
                var data = {
                    data: serialize
                };
                $.post(url, data, function (res) {
                    if (res.success == 1) {
                        $('.dd-list').closest('#nestable').html(res.html);
                    } else {
                        init.notyPopup(res.mess, 'error');
                    }
                });
            });

            $(document).on('click', '.btn-select-file', function () {
                init.openFileModal(callback);
            });
            $(document).on('change', '.type', function () {
                switch ($(this).val()) {
                    case '{{$Service::TYPE_TEXT}}':
                        $('.pages').hide();
                        $('.image').hide();
                        break;
                    case '{{$Service::TYPE_SINGLE_PAGE}}':
                        $('.pages').show();
                        $('.image').hide();
                        break;
                    case '{{$Service::TYPE_SOCIAL}}':
                        $('.image').show();
                        $('.pages').hide();
                        break;
                    case '{{$Service::TYPE_IMAGE}}':
                        $('.image').show();
                        $('.pages').hide();
                        break;
                }
            })

        });
        var callback = function (data) {
            $('.img').val(data.url);
            $('.img-show').attr('src', data.url);
        }

        var page = {
            preload: function () {
                var html = '<option></option>';
                return html;
            },
            loadPages: function (selectProvince) {
                var url = BASE_URL + '/admin/article/loadPages/' + selectProvince;
                $('.page').html(this.preload);
                $.get(url, function (res) {
                    if (res.success == 1) {
                        $('.page').append(res.html);
                    } else {
                        init.notyPopup(res.mess, 'error');
                    }
                });
            },
        }

        $('.btn-add-social').click(function () {
            let html = '<div class="item-social mb-3">\n' +
                '<div class="form-group row mb-1">\n' +
                '<div class="col-md-3">\n' +
                '<label class="col-form-label ml-3">Tên Social' +
                '</label>\n' +
                '</div>\n' +
                '<div class="col-md-8">\n' +
                '<input type="text" class="form-control" name="social[][\'name\']" placeholder="Tên social" value="">\n' +
                '</div>\n' +
                '<div class="col-md-1">\n' +
                '<a href="javascript:void(0);" class="text-danger  btn-rm-social">\n' +
                '<i class="fa fa-trash icon-sm" aria-hidden="true"></i>\n' +
                '</a>\n' +
                '</div>\n' +
                '</div>\n' +
                '<div class="form-group row mb-1">\n' +
                '<div class="col-md-3">\n' +
                '<label class="col-form-label ml-3">Link Social</label>\n' +
                '</div>\n' +
                '<div class="col-md-8">\n' +
                '<input type="text" class="form-control" name="social[][\'link\']" placeholder="Link social" value="">\n' +
                '</div>\n' +
                '</div>\n' +
                '<div class="form-group row mb-1">\n' +
                '<div class="col-md-3">\n' +
                '<label class="col-form-label ml-3">Icon Social</label>\n' +
                '</div>\n' +
                '<div class="col-md-8">\n' +
                '<input type="text" class="form-control" name="social[][\'icon\']" placeholder="Icon social" value="">\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>';
            $('.social').append(html);
        });
    </script>
@endsection
