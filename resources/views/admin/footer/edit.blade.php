@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật Liên Kết' : 'Tạo Liên Kết' }}
@endsection
@section('content')
<form class="forms-sample" action="" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin liên kết</h4>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input type="text"  class="form-control title" name="code" placeholder="Tiêu đề"
                            value="{{ $data->code }}">
                        @if($errors->has('code'))
                        <p class="text-danger">{{ $errors->first('code') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="editor1">Nội dung</label>
                        @if($errors->has('value'))
                        <p class="text-danger">{{ $errors->first('value') }}</p>
                        @endif
                        <textarea class="form-control ckeditor" name="value" id="editor1"
                            rows="5">{{ isset($data->value) ? $data->value : old('value') }}</textarea>
                    </div>
                    <button type="submit"
                        class="btn btn-success mr-2 has-spinner">{{ $id > 0 ? 'Cập nhật' : 'Tạo mới' }}</button>
                    <a href="{{ route('admin.footerSocial.getList') }}" class="btn btn-light">Hủy</a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
