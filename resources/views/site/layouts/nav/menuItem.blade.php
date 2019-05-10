<li class="{{ $item->class_name }}">
    <a href="{{ route('site.home.category',$item->slug) }}">{!! $item->name !!}</a>
    @if ($item->submenu)
        <ul>
            @foreach ($item->submenu as $sub)
                @include('site.layouts.nav.menuItem', ['item'=>$sub])
            @endforeach
        </ul>
    @endif
</li>