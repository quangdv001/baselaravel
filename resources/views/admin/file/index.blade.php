@extends('admin.layout.main')
@section('title')
Media
@endsection
@section('content')
<!-- Breadcrumb-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">Home</li>
    <li class="breadcrumb-item">
        <a href="#">Admin</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Media</div>
                    <div class="card-body">
                        <div class="media-block">
                            <div class="image-upload text-center">
                                <label for="file-input">
                                    <i class="mdi mdi-upload icon-picture"></i>
                                </label>

                                <input id="file-input" type="file" multiple onchange="init.handleFile(this.files)" />
                            </div>
                            <ul class="list-img">
                                @if(sizeof($data) > 0)
                                @foreach($data as $v)
                                @if(file_exists('storage/upload/files/'.$v->path))
                                <li class="img-item" data-id="{{ $v->id }}">
                                    <img width="196" height="196" @if($v->type == 'zip')
                                    src="http://thuthuatphanmem.vn/uploads/2014/11/17/winrar_103356.png" @else
                                    src="{{ $v->url }}" @endif alt="">
                                    <div class="img-bot clearfix">
                                        <span class="img-name pull-left">{{ $v->name }}</span>
                                        <a href="javascript:void(0);" data-id="{{ $v->id }}"
                                            class="img-btn btn-rm-img pull-right"><i
                                                class="icon-trash text-danger"></i></a>
                                        <a href="{{ route('admin.file.downloadFile', $v->id) }}" data-id="{{ $v->id }}"
                                            class="img-btn btn-dl pull-right"><i
                                                class="icon-cloud-download text-info"></i></a>
                                    </div>
                                </li>
                                @endif


                                @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- /.row-->
    </div>
</div>
@endsection
