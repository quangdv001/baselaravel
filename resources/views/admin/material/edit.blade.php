@extends('admin.layout.main')
@section('title')
{{ $id > 0 ? 'Cập nhật vật liệu' : 'Tạo vật liệu' }}
@endsection
@section('content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Material</li>
</ol>

<form class="forms-sample" action="" method="post">
    @csrf
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Thông tin cơ bản</strong></div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Tên vật liệu</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Tên"
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
        //
    })

</script>
@endsection
