@if (count($latestProjects) > 0)
    <h3 class="module-title"><a href="#">Dự án mới</a></h3>
    <div class="list-course">
    @foreach ($latestProjects as $key=>$item)
        <div class="row"><div class="col">
            <div class="block gray-block">
                <div class="cover-image"><img src="{{ $item->img}}" alt=""/>
                </div>
                <div class="title">
                <h3><a href="/posts/{{ $item->slug}}">{{ $item->title }}</a></h3>
                </div><a class="btn btn-raised btn-md btn-brand" href="/posts/{{ $item->slug}}"><i class="inc-icon inc-play"> </i><span>Xem chi tiết</span></a>
                <div class="block-info">
                <a class="meta-info-item" href="/users/{{ $item->admin_name_c}}">{{ $item->admin_name_c }}</a>
                    <span class="meta-info-item">
                        <i class="far fa-clock"></i> {{$item->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div></div>
        @endforeach
    </div>
@else
    <h3 class="module-title"><a href="#">Dự án mới nhất</a></h3>
    <div class="content">Không có bài viết</div>
@endif
