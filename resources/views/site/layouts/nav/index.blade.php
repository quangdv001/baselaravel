@if ($menu)
    <ul>
        @foreach ($menu as $item)
            @include('site.layouts.nav.menuItem', ['item'=>$item])
        @endforeach
    </ul>
@endif