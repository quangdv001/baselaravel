<div class="block-title underline">
    <h2 class="title solid-color text-uppercase"><span>Tin Tức</span></h2>
</div>
<div class="row">
    <ul class="list-head">
        @foreach ($headerNews as $key=>$item)
            <li><a class="title" href="{{ route('site.home.showDetail', ['slugCategory' => $item->category->slug, 'slugDetail' => $item->slug]) }}"><span><i class="far fa-clock"></i></span><span>&nbsp;{{ $item->title }}</span></a></li>
        @endforeach
    </ul>
    
</div>