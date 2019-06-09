@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật nhóm quyền' : 'Tạo nhóm quyền' }}
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

<form class="forms-sample" action="" method="post">
    @csrf
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thông tin cơ bản</strong></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tên nhóm quyền</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Tài khoản" required
                                        value="{{ isset($data->name) ? $data->name : old('name') }}">
                                    @if($errors->has('name'))
                                    <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">
                                <i class="fa fa-dot-circle-o"></i> Submit</button>
                            <button class="btn btn-sm btn-danger" type="reset">
                                <i class="fa fa-ban"></i> Reset</button>
                        </div>
                    </div>
                </div>
                @if($id > 0)
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Phân quyền</strong> </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Id
                                            </th>
                                            <th>
                                                Tên quyền
                                            </th>
                                            <th>
                                                Mã quyền
                                            </th>
                                            <th>
                                                Hành động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="permission-content">
                                        @if(isset($data->permission) && $data->permission)
                                        @foreach($data->permission as $v)
                                        <tr>
                                            <td>
                                                {{ $v->id }}
                                            </td>
                                            <td>
                                                {{ $v->name }}
                                            </td>
                                            <td>
                                                {{ $v->code }}
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="text-warning edit_permission_btn mr-4" data-id="{{ $v->id }}"
                                                    data-name="{{ $v->name }}" data-code="{{ $v->code }}">
                                                    <i class="fa fa-pencil-square-o icon-sm" aria-hidden="true"></i>
                                                </a>
                                                <a href="javascript:void(0)" data-id="{{ $v->id }}"
                                                    class="text-danger rm_permission_btn">
                                                    <i class="fa fa-trash icon-sm" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Tên quyền</label>
                                        <input type="text" class="form-control permission_name"
                                            placeholder="Tên quyền" />
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Mã quyền</label>
                                        <input type="text" class="form-control permission_code"
                                            placeholder="Mã quyền" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{--<label>abc</label>--}}
                                        <input type="hidden" class="permission_id" value="0">
                                        <input type="hidden" class="group_id" value="{{ $id }}">
                                        <button class="btn btn-info btn-fw mr-2 mt-4 has-spinner permission_btn">Lưu
                                        </button>
                                        <button class="btn btn-warning btn-fw mt-4 has-spinner permission_cancel">Hủy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- <button class="btn btn-sm btn-primary" type="submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit</button>
                                <button class="btn btn-sm btn-danger" type="reset">
                                    <i class="fa fa-ban"></i> Reset</button> --}}
                        </div>
                    </div>
                </div>
                @else
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Phân quyền</strong> </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>
                                                Tên quyền
                                            </th>
                                            <th>
                                                Mã quyền
                                            </th>
                                            <th>
                                                Hành động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="permission-content">
                                        @if(isset($data->permission) && $data->permission)
                                        @foreach($data->permission as $v)
                                        <tr>
                                            <td>

                                                <input type="hidden" name="pms[][name]">
                                            </td>
                                            <td>

                                                <input type="hidden" name="pms[][code]">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)" class="text-danger rm_pms_btn">
                                                    <i class="fa fa-trash icon-sm" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Tên quyền</label>
                                        <input type="text" class="form-control permission_name"
                                            placeholder="Tên quyền" />
                                    </div>
                                </div>
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label>Mã quyền</label>
                                        <input type="text" class="form-control permission_code"
                                            placeholder="Mã quyền" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{--<label>abc</label>--}}
                                        <input type="hidden" class="permission_id" value="0">
                                        <input type="hidden" class="group_id" value="{{ $id }}">
                                        <button
                                            class="btn btn-info btn-fw mr-2 mt-4 has-spinner @if($id > 0) permission_btn @else pms_btn_create @endif">Lưu
                                        </button>
                                        <button class="btn btn-warning btn-fw mt-4 has-spinner permission_cancel">Hủy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{-- <button class="btn btn-sm btn-primary" type="submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit</button>
                                <button class="btn btn-sm btn-danger" type="reset">
                                    <i class="fa fa-ban"></i> Reset</button> --}}
                        </div>
                    </div>
                </div>
                @endif

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
            $('.permission_btn').click(function (e) {
                e.preventDefault();
                var permission_id = $('.permission_id').val();
                var permission_name = $('.permission_name').val();
                var permission_code = $('.permission_code').val();
                var group_id = $('.group_id').val();

                if(permission_name == '' || permission_code == ''){
                    init.notyPopup('Tên quyền + Mã quyền không được rỗng!', 'error');
                    return false;
                }

                var url = BASE_URL + '/admin/permission/editPermission';
                var data = {id: permission_id, name: permission_name, code: permission_code, group_id: group_id};
                $('.bl-edit-permission').preloader();
                $.post(url, data, function (res) {
                    if (res.success == 1) {
                        $('.permission-content').html(res.html);
                        $('.permission_name, .permission_code').val('');
                        $('.permission_id').val(0);
                        init.notyPopup(res.msg, 'success');
                    } else {
                        init.notyPopup(res.msg, 'error');
                    }
                    $('.bl-edit-permission').preloader('remove');
                })
            });

            $(document).on('click', '.edit_permission_btn', function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var code = $(this).data('code');
                $('.permission_id').val(id);
                $('.permission_name').val(name);
                $('.permission_code').val(code);
            });

            $(document).on('click', '.rm_permission_btn', function () {
                var id = $(this).data('id');
                var group_id = $('.group_id').val();
                var url = BASE_URL + '/admin/permission/removePermission';
                var data = {id: id, group_id: group_id};
                $('.bl-edit-permission').preloader();
                if(confirm('Bạn có chắc muốn xóa quyền này không?')){
                    $.post(url, data, function (res) {
                        if (res.success == 1) {
                            $('.permission-content').html(res.html);
                            init.notyPopup(res.msg, 'success');
                        } else {
                            init.notyPopup(res.msg, 'error');
                        }
                        $('.bl-edit-permission').preloader('remove');
                    })
                }
            });

            $('.permission_cancel').click(function (e) {
                e.preventDefault();
                $('.permission_id').val(0);
                $('.permission_name').val('');
                $('.permission_code').val('');
            })

            $('.pms_btn_create').click(function(e){
                e.preventDefault();
                var name = $('.permission_name').val();
                var code = $('.permission_code').val();

                if(name == '' || code == ''){
                    init.notyPopup('Tên quyền + Mã quyền không được rỗng!', 'error');
                    return false;
                }

                var key = Math.random();
                var html = '<tr>\n' +
                    '                                                <td>\n' +
                    '                                                    \n' + name +
                    '                                                    <input type="hidden" name="pms['+ key +'][name]" value="'+ name +'">\n' +
                    '                                                </td>\n' +
                    '                                                <td>\n' +
                    '                                                    \n' + code +
                    '                                                    <input type="hidden" name="pms['+ key +'][code]" value="'+ code +'">\n' +
                    '                                                </td>\n' +
                    '                                                <td>\n' +
                    '                                                    <a href="javascript:void(0)" class="text-danger rm_pms_btn">\n' +
                    '                                                        <i class="fa fa-trash icon-sm" aria-hidden="true"></i>\n' +
                    '                                                    </a>\n' +
                    '                                                </td>\n' +
                    '                                            </tr>';
                $('.permission-content').append(html);
                $('.permission_name, .permission_code').val('');
            });

            $(document).on('click','.rm_pms_btn', function(){
               $(this).parent().parent().remove();
            });

        })
    </script>
@endsection
