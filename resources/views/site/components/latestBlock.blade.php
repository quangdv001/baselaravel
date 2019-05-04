<div class="module-title">
    <div class="module-title solid-color"><a>{!! $moduleTitle ? $moduleTitle : 'Latest Block' !!}</a></div>
</div>
@if ($news && count($news) > 0)
    @foreach ($news as $key=>$item)
        @if ($type && $type === 'thumb')
            @include('site.elements.itemThumbNew', ['item'=>$item])
        @else
            @include('site.elements.itemTitleNew', ['item'=>$item])
        @endif
    @endforeach
@else
    <div class="content">Không có bài viết</div>
@endif