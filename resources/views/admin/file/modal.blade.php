<div class="modal fade" id="fileModal">
    <div class="modal-dialog modal-xl">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="display:block">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title pull-left">Media Library</h4>
            </div>
            <div class="modal-body">
                <div class="media-block clearfix">
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
                    <li class="img-item" data-id="{{ $v->id }}" data-url="{{ $v->url }}" data-path="{{ $v->path }}">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-choose-file">Submit</button>
            </div>
        </div>

    </div>
</div>
