@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật quảng cáo' : 'Tạo quảng cáo' }}
@endsection
@section('content')
<form class="forms-sample" action="" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin cơ bản</h4>
                    <div class="form-group">
                        <label>Tên</label>
                        <input type="text" class="form-control name" name="name" placeholder="Tiêu đề"
                            value="{{ isset($data->name) ? $data->name : old('name') }}">
                        @if($errors->has('name'))
                        <p class="text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" class="form-control url" name="url" placeholder="URL"
                            value="{{ isset($data->url) ? $data->url : old('url') }}">
                        @if($errors->has('url'))
                        <p class="text-danger">{{ $errors->first('url') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Từ</label>
                        <div class='input-group date ' id='datetimepicker6'>
                            <input type='text' class="form-control start_time" name="start_time"
                                value="{{ isset($data->start_time) ? date('H:i:s d/m/Y', $data->start_time) : old('start_time') }}" />
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Đến</label>
                        <div class='input-group date ' id='datetimepicker7'>
                            <input type='text' class="form-control end_time" name="end_time"
                                value="{{ isset($data->end_time) ? date('H:i:s d/m/Y', $data->end_time) : old('end_time') }}" />
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ảnh</label>
                        <input type="hidden" name="img" class="img"
                            value="{{isset($data->img) ? $data->img : old('img')}}">
                        <br>
                        <a href="javascript:void(0)" class="btn btn-info btn-select-file">Chọn ảnh</a>
                        <div class="bl-img-show mt-4">
                            <img src="{{ isset($data->img) ? $data->img : old('img') }}" class="img-show" width="90"
                                height="90" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editor2">Mô tả</label>
                        <textarea class="form-control" name="content"
                            rows="5">{{ isset($data->content) ? $data->content : old('content') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Trạng thái</label>
                        <select class="form-control" name="status" id="exampleFormControlSelect2">
                            <option value="1">Hoạt động</option>
                            <option value="0" @if(isset($data->status) && $data->status == 0) selected @endif>Ngừng hoạt
                                động</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="btn btn-success mr-2 has-spinner">{{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                    <a href="{{ route('admin.advertise.getList') }}" class="btn btn-light">Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn-select-file', function () {
            init.openFileModal(callback);
        });

        $('#datetimepicker6').datetimepicker({
            format: 'HH:mm:ss DD/MM/YYYY'
        });
        $('#datetimepicker7').datetimepicker({
            format: 'HH:mm:ss DD/MM/YYYY',
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
    });
    var callback = function (data) {
        $('.img').val(data.url);
        $('.img-show').attr('src', data.url);
    }

</script>
@endsection
