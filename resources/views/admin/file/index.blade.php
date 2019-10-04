@extends('admin.layout.main')
@section('title')
Danh sách Media Library
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card bl-form">
            <div class="card-body">
                <h4 class="card-title">Media Library</h4>
                <hr>
                <div class="media-block">
                    <div class="image-upload text-center">
                        <label for="file-input">
                            <i class="mdi mdi-upload icon-upload"></i>
                        </label>

                        <input id="file-input" type="file" onchange="init.handleFile(this.files)" />
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
                                        class="mdi mdi-folder-remove text-danger"></i></a>
                                <a href="{{ route('admin.file.downloadFile', $v->id) }}" data-id="{{ $v->id }}"
                                    class="img-btn btn-dl pull-right"><i
                                        class="mdi mdi-folder-download text-info"></i></a>
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
</div>
@endsection
@section('custom_css')
<style>


</style>
@endsection
