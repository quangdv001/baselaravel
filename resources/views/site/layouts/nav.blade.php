{{-- {!! $menu !!} --}}
@if ($menu)
    <ul class="navigation">
        @foreach ($menu as $item)
            {{-- <li>
                <a href="#">{!! $item->name !!}</a>
                @if ($item->submenu)
                    @foreach ($item->submenu as $sub)
                    submenu {{ $sub->name }}
                    @endforeach
                @endif
            </li> --}}
            @include('site.layouts.nav.menuItem', ['item'=>$item])
        @endforeach
    </ul>
@endif