<a href="#"><i
    class="material-icons">shopping_cart</i>&nbsp;&nbsp;
    {{-- <span
    class="cart-count">{{ $count }}</span> --}}
    <span class="isMobile">&nbsp;Giỏ hàng</span></a>
<ul>
@if(sizeof($data) > 0)
    @foreach($data as $v)
    <li><span>
            <div class="cart-product-thumb"><img
            src="{{ $v->options->img }}" />
            </div>
            <div class="cart-product-title">{{ $v->name }}</div>
            <div class="cart-product-price">{{ number_format($v->subtotal,0,",",".") }} đ</div>
        </span>
    </li>
    @endforeach

<li class="cart-total-row"><span>
        <div class="cart-product-total">TỔNG: </div>
        <div class="cart-product-price">{{ Cart::subtotal() }} đ</div>
    </span>
</li>
<li class="text-center btn btn-primary"><a href="{{ route('site.cart.index') }}"><i
            class="material-icons">local_grocery_store</i><span
            class="_isMobile">&nbsp;Thanh toán</span></a>
</li>
@endif
</ul>