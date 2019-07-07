<div class="header-layout">
    <div class="header fix-top">
        <div class="container">
            <div class="row">
                <div class="col align-self-center zero-height-sx">
                    <!-- NAVIGATION -->
                    <div class="navigation nav-left">
                        <ul>
                            <li><a href="tell: 123456789"><i class="material-icons">phone_in_talk</i><span
                                        class="_isMobile">&nbsp;012 345 678</span></a>
                            </li>
                            <li><a href="tell: 123456789"><i class="material-icons">mail_outline</i><span
                                        class="_isMobile">&nbsp;homefun@gmail.com</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-auto col-12">
                    <h3 class="logo" id="logo"><a href="{{ route('site.home.index') }}"><img
                                src="{{ asset('public/assets/site/themes/assets/images/logo2.png') }}"></a></h3>
                </div>
                <div class="col align-self-center text-right zero-height-sx">
                    <!-- NAVIGATION -->
                    <div class="navigation nav-right">
                        <ul>
                            @auth
                            <li><a href="./index.html"><span class="user-avatar"><img
                                            src="https://png.pngtree.com/svg/20170920/4ff36bf59e.svg" /></span><span
                                        class="_isMobile">&nbsp;{{ $user->name ? $user->name : $user->email }}</span></a>
                                <ul>
                                    <li><a href="#"><i class="material-icons">account_circle</i><span
                                                class="_isMobile">&nbsp;Thông tin tài khoản</span></a>
                                    </li>
                                    <li><a href="#"><i class="material-icons">message</i><span
                                                class="_isMobile">&nbsp;Thông báo</span></a>
                                    </li>
                                    <li><a href="{{ route('site.auth.logout') }}"><i class="material-icons">power_settings_new</i><span
                                                class="_isMobile">&nbsp;Thoát</span></a>
                                    </li>
                                </ul>
                            </li>
                            @endauth
                            @guest
                            <li><a href="{{ route('site.auth.getLogin') }}"><span
                                        class="material-icons _isMobile">vpn_key</span><span>&nbsp;Đăng nhập</span></a>
                            </li>
                            <li><a href="{{ route('site.auth.getRegister') }}"><span
                                        class="material-icons _isMobile">person_add</span><span>&nbsp;Đăng ký</span></a>
                            </li>
                            @endguest
                            <li class="cart-product">
                                <a href="#"><i
                                        class="material-icons">shopping_cart</i>&nbsp;&nbsp;
                                        {{-- <span
                                        class="cart-count">{{ Cart::content()->count() }}</span> --}}
                                        <span class="isMobile">&nbsp;Giỏ hàng</span></a>
                                <ul>
                                    @if(sizeof(Cart::content()) > 0)
                                        @foreach(Cart::content() as $v)
                                        <li><span>
                                                <div class="cart-product-thumb"><img
                                                src="{{ $v->options->img }}" />
                                                </div>
                                                <div class="cart-product-title">{{ $v->name }}</div>
                                                <div class="cart-product-price">{{ number_format($v->price,0,",",".") }} đ</div>
                                            </span>
                                        </li>
                                        @endforeach
                                    @endif
                                    <li class="cart-total-row"><span>
                                            <div class="cart-product-total">TỔNG: </div>
                                            <div class="cart-product-price">{{ Cart::subtotal() }} đ</div>
                                        </span>
                                    </li>
                                    <li class="text-center btn btn-primary"><a href="{{ route('site.cart.index') }}"><i
                                                class="material-icons">local_grocery_store</i><span
                                                class="_isMobile">&nbsp;Thanh toán</span></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
