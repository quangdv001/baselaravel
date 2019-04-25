@if (count($latestProjects) > 0)
    <h3 class="module-title"><a href="#">Dự án mới</a></h3>
    <div class="list-course">
    @foreach ($latestProjects as $key=>$item)
        <div class="row"><div class="col">
            <div class="block gray-block">
                <div class="cover-image"><img src="{{ $item->img}}" alt=""/>
                </div>
                <div class="title">
                <h3><a href="project-detail.html">Dự án title 2</a></h3>
                </div><a class="btn btn-raised btn-md btn-brand" href="/posts/{{ $item->slug}}"><i class="inc-icon inc-play"> </i><span>Xem chi tiết</span></a>
                <div class="block-info">
                    <a class="meta-info-item" href="/posts/{{ $item->slug}}">Dự án</a>
                    <span class="meta-info-item">
                        <i class="far fa-clock"></i> {{$item->created_at->toFormattedDateString() }}
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
