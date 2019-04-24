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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Thời gian chạy</label>
                                <input type='text' class="form-control time" name="time"
                                    value="{{ isset($data->start_time) ? (date('d/m/Y', $data->start_time) . ' - '. date('d/m/Y', $data->end_time)) : old('time') }}" />
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
        $('.time').daterangepicker({
            opens: 'left',
            locale: {
                format: 'DD/MM/YYYY'
            }
        }, function (start, end, label) {
            console.log("A new date selection was made: " + start.format('DD/MM/YYYY') + ' to ' + end
                .format('DD/MM/YYYY'));
        });

    });
    var callback = function (data) {
        $('.img').val(data.url);
        $('.img-show').attr('src', data.url);
    }

</script>
@endsection
