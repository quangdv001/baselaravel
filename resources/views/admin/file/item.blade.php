<li class="img-item" data-id="{{ $data->id }}">
    <img width="196" height="196" @if($data->type == 'zip') src="http://thuthuatphanmem.vn/uploads/2014/11/17/winrar_103356.png" @else src="{{ $data->url }}" @endif alt="">
    <div class="img-bot clearfix">
        <span class="img-name pull-left">{{ $data->name }}</span>
        <a href="javascript:void(0);" data-id="{{ $data->id }}" class="img-btn btn-rm-img pull-right"><i
                class="mdi mdi-folder-remove text-danger"></i></a>
        <a href="{{ route('admin.file.downloadFile', $data->id) }}" data-id="{{ $data->id }}" class="img-btn btn-dl pull-right"><i
                class="mdi mdi-folder-download text-info"></i></a>
    </div>
</li>
