
<div class="top-layout">
    <div class="container">
        <div class="row">
        <div class="top">
            <div class="top-element">
                    @if ($topMenu)
                        @include('site.layouts.nav', ['categories'=>$topMenu])
                    @endif
            {{-- <ul>
                <li><span><strong> <i class="material-icons">phone_in_talk</i>&nbsp;</strong><a href="#link">Liên hệ quảng cáo&nbsp;</a></span></li>
                <li><span class="separate"></span></li>
                <li><span><strong><i class="material-icons">send</i>&nbsp;</strong><a href="#link">Gửi tin nhanh&nbsp;</a></span></li>
            </ul> --}}
            </div>
            <div class="pull-right">
            <ul>
                <li>
                <div class="social-icon"><a><i class="fab fa-facebook-f"></i></a>
                </div>
                </li>
                <li>
                <div class="social-icon"><a><i class="fab fa-google-plus-g"></i></a>
                </div>
                </li>
                <li>
                <div class="social-icon"><a><i class="fab fa-youtube"></i></a>
                </div>
                </li>
                <li>
                <div class="social-icon"><a><i class="fab fa-twitter"></i></a>
                </div>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div>
</div>