@if ($menu)
    <ul class="navigation">
        @foreach ($menu as $item)
            @include('site.layouts.nav.menuItem', ['item'=>$item])
        @endforeach
    </ul>
@endif