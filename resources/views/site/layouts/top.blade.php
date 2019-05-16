
<div class="top-layout">
    <div class="container">
        <div class="row">
        <div class="top">
            <div class="top-element">
                @if ($topMenu)
                    @include('site.layouts.nav.index', ['menu'=>$topMenu])
                @endif
            </div>
            <div class="pull-right">
                <div class="navigation nav-social-top">
                    @if ($socialMenu)
                        @include('site.layouts.nav.index', ['menu'=>$socialMenu])
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
</div>