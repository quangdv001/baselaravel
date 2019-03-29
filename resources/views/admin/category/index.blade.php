@extends('admin.layout.main')
@section('title')
Danh sách danh mục
@endsection
@section('content')
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="title clearfix">
                    <h4 class="card-title pull-left">Danh sách danh mục</h4>
                    <div class="pull-right"><button type="button" class="btn btn-sm btn-primary btn-add-category">Tạo danh mục</button>
                    </div>
                </div>
                <div class="cf nestable-lists">
                    <div class="dd" id="nestable">
                        {!! $html !!}
                        {{-- <ol class="dd-list">
                            <li class="dd-item dd3-item" data-id="13">
                                <div class="dd-handle dd3-handle"></div>
                                <div class="dd3-content">
                                    <div class="pull-left">
                                        <span class="text-category">item 1</span>
                                    </div>
                                    <div class="pull-right">
                                        <a href="javascript:void(0);" class="text-warning mr-2 btn-edit" data-id="1"><i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0);" class="text-danger rm_group_btn btn-rm" data-id="1"><i class="fa fa-trash icon-sm" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li class="dd-item dd3-item" data-id="14">
                                <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 14</div>
                            </li>
                            <li class="dd-item dd3-item" data-id="15">
                                <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 15</div>
                                <ol class="dd-list">
                                    <li class="dd-item dd3-item" data-id="16">
                                        <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 16</div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="17">
                                        <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 17</div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="18">
                                        <div class="dd-handle dd3-handle"></div><div class="dd3-content">Item 18</div>
                                    </li>
                                </ol>
                            </li>
                        </ol> --}}
                    </div>
                </div>
                <p><strong>Serialised Output (per list)</strong></p>
                <textarea id="nestable-output"></textarea>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card bl-form">
            <div class="card-body">
                <h4 class="card-title">Chi tiết danh mục - <span class="category-id">0</span></h4>
                <input type="hidden" name="id" class="id" value="0">
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" class="form-control name" name="name" placeholder="Tên danh mục" value="">
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control url" name="url" placeholder="URL" value="">
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control description" name="description" id="exampleTextarea1" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Trạng thái</label>
                    <select class="form-control status" id="exampleFormControlSelect2">
                        <option value="1">Hoạt động</option>
                        <option value="0">Ngừng hoạt động</option>
                    </select>
                </div>
                <button type="button" class="btn btn-success mr-2 has-spinner btn-update">Cập nhật</button>
                <button class="btn btn-danger">Xóa</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('lib_js')
<script src="{{ asset('assets/admin/plugins/nestable/jquery.nestable.js') }}"></script>
@endsection
@section('lib_css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/nestable/custom.css') }}">
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
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
        $('.btn-add-category').click(function(){
            var url = BASE_URL + '/admin/category/create';
            $.post(url, function(res){
                console.log(res);
                if(res.success == 1){
                    var newCategory = '<li class="dd-item dd3-item" data-id="'+ res.data.id +'">'+
                                '<div class="dd-handle dd3-handle"></div>'+
                                '<div class="dd3-content">'+
                                    '<div class="pull-left">'+
                                        '<span class="text-category">'+ res.data.name + '-' + res.data.id +'</span>'+
                                    '</div>'+
                                    '<div class="pull-right">'+
                                        '<a href="javascript:void(0);" class="text-warning mr-2 btn-edit" data-id="'+ res.data.id +'"><i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i></a>'+
                                        '<a href="javascript:void(0);" class="text-danger rm_group_btn btn-rm" data-id="'+ res.data.id +'"><i class="fa fa-trash icon-sm" aria-hidden="true"></i></a>'+
                                    '</div>'+
                                '</div>'+
                            '</li>';
                    $('.dd-list').closest('#nestable').prepend(newCategory);
                    $('.id').val(res.data.id);
                    $('.category-id').text(res.data.id);
                    $('.name').val(res.data.name);
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        });

        $('.btn-update').click(function(){
            var id = $('.id').val();
            var name = $('.name').val();
            var description = $('.description').val();
            var status = $('.status').val();
            var urll = $('.url').val();
            var url = BASE_URL + '/admin/category/update/' + id;
            var data = {id:id, name:name, description:description, status:status, url:urll};
            $.post(url, data, function(res){
                if(res.success == 1){
                    init.notyPopup(res.mess, 'success');
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        });

        $(document).on('click', '.btn-edit', function(e){
            $('.dd3-content').removeClass('active');
            $(this).parent().parent().addClass('active');
            var obj = $('.bl-form');
            var id = $(this).data('id');
            var url = BASE_URL + '/admin/category/' + id;
            init.showLoader(obj);
            $.get(url, function(res){
                init.hideLoader(obj);
                if(res.success == 1){
                    $('.id').val(res.data.id);
                    $('.category-id').text(res.data.id);
                    $('.name').val(res.data.name);
                    $('.url').val(res.data.url);
                    $('.description').val(res.data.description);
                    $('.status').val(res.data.status);
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            });
        })
        $(document).on('click', '.btn-rm', function(e){
            console.log(2);
        })
    });

</script>
@endsection
