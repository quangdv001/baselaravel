@extends('admin.layout.main')
@section('title')
Lịch sử giao dịch
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    {{-- <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li> --}}
    <li class="breadcrumb-item active">Giao dịch</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Lọc</div>
                    <div class="card-body">
                        <form class="forms-sample" action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Tên khách hàng</label>
                                        <input type="text" class="form-control" id="" name="name"
                                            placeholder="Tên khách hàng" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Email khách hàng</label>
                                        <input type="text" class="form-control" id="" name="email"
                                            placeholder="Email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="">&nbsp;</label>
                                        <button type="submit" class="btn btn-success mr-2 d-block">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="text-left">

                            <i class="fa fa-align-justify"></i>Lịch sử giao dịch
                        </div>
                        <div class="right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                                Thêm mới
                              </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if(sizeof($data) > 0)
                            <table class="table table-bordered myTable1">
                                <thead>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Khách hàng
                                        </th>
                                        <th>
                                            Số tiền
                                        </th>
                                        <th>
                                            Thời gian
                                        </th>          
                                        <th>
                                            Thời gian tạo
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $v)
                                    <tr>
                                        <td>
                                            {{ $v->id }}
                                        </td>
                                        <td>
                                        <div>Họ tên: {{ $v->user->name }}</div>
                                        <div>Email: {{ $v->user->email }}</div>
                                        </td>
                                        <td>
                                            {{ number_format($v->amount) }}đ
                                        </td>
                                        <td>
                                            {{ floor($v->duration / 86400) }} ngày
                                        </td>
                                        
                                        <td>
                                            {{ $v->created_at->format('H:i:s d/m/Y') }}
                                        </td>
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="wrap-link">
                                <div class="pull-right mt-4">{{ $data->links() }}</div>
                            </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gia hạn người dùng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="">Khách hàng</label>
                  <select class="form-control d-block user_id select2" name="" id="">
                    <option value="0">Mời chọn</option>
                    @if(sizeof($customer) > 0)
                    @foreach($customer as $v) 
                    <option value="{{ $v->id }}">{{ $v->email }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Số tiền</label>
                  <input type="number"
                    class="form-control amount" name="" id="" aria-describedby="helpId" placeholder="">
                </div>
                <div class="form-group">
                  <label for="">Thời gian (ngày)</label>
                  <input type="number"
                    class="form-control duration" name="" id="" aria-describedby="helpId" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary add-new has-spinner">Thêm</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>
    $("#modelId").on('shown.bs.modal', function () {
        $('.select2').select2({
            matcher: matchCustom
        });
        
    });
    function matchCustom(params, data) {
        // If there are no search terms, return all of the data
        if ($.trim(params.term) === '') {
        return data;
        }

        // Do not display the item if there is no 'text' property
        if (typeof data.text === 'undefined') {
        return null;
        }

        // `params.term` should be the term that is used for searching
        // `data.text` is the text that is displayed for the data object
        if (data.text.indexOf(params.term) > -1) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.text += ' (matched)';

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
        }

        // Return `null` if the term should not be displayed
        return null;
    }

    $('.add-new').click(function(){
        var user_id = $('.user_id').val();
        var amount = $('.amount').val();
        var duration = $('.duration').val();
        $.ajax({
            url: BASE_URL + '/admin/transaction/getCreate',
            data: {user_id, amount, duration},
            type: 'post',
            beforeSend: function() {
                $('.add-new').buttonLoader('start');
            },
            success: function (res) {
                if (res.success == 1) {
                    init.notyPopup('Thêm thành công!', 'success');
                    setTimeout(function(){
                        window.location.reload();
                    }, 1000)
                } else {
                    init.notyPopup(res.mess, 'error');
                }
            },
            complete: function() {
                $('.add-new').buttonLoader('stop');
            },
            error: function(xhr) { // if error occured
                init.notyPopup('Có lỗi xảy ra', 'error');
            },
        });
    })
    
</script>
@endsection
