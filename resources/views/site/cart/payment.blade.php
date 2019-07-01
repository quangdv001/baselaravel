@extends('site.layout.main')
@section('title')
Bảng dự trù
@endsection
@section('content')
<div class="main">
    <div class="menubar-wrapper">
        <div class="container">
            <div class="row d-flex align-items-center">
                @if(sizeof($category) > 0)
                <ul class="mb-left-bar col-auto">
                    @foreach($category as $v)
                    @if($v->type != 0)
                    @if($v->type == 1)
                    <li><a
                            href="{{ route('site.article.index',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->name }}</a>
                    </li>
                    @elseif($v->type == 2)
                    <li><a
                            href="{{ route('site.product.list',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->name }}</a>
                    </li>
                    @elseif($v->type == 3)
                    <li><a
                            href="{{ route('site.article.list',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->name }}</a>
                    </li>
                    @endif
                    @endif
                    @endforeach
                </ul>
                @endif
                <div class="mb-right-bar col align-self-end d-flex justify-content-end">
                    <div class="support-float"><i class="material-icons">headset_mic</i>
                        <h4><span class="text-uppercase">Nếu bạn gặp sự cố hãy liên hệ với chúng tôi</span></h4>
                        <p><span>Hotline: </span><a class="hotline" href="tel: 0987 141 888">0987 141 888</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section section-subpage section-app-page d-flex align-items-center">
        <div class="container text-center">
            <div class="app-panel">
                <div class="block-title underline">
                    <h1 class="title solid-color text-uppercase"><span>Bảng dự trù chi phí sản phẩm</span></h1>
                </div>
                <p class="subtitle">* Quý khách vui lòng điền thông tin vào các mục: Chiều dài, rông, cao, số lượng của
                    sản phẩm</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><span>STT</span></th>
                                <th style="min-width: 220px;"><span>Hạng mục</span></th>
                                <th><span>Đơn vị</span></th>
                                <th colspan="3" width="30%" style="padding: 0">
                                    <div style="padding: .75em;border-bottom: 1px solid rgba(0,0,0,.06)">Kích thước (mm)
                                    </div>
                                    <table class="table table-striped"
                                        style="width: 100%; background-color:transparent;margin-bottom: 0;">
                                        <thead>
                                            <th style="width: 60px;">Dài</th>
                                            <th style="width: 60px;">Rộng</th>
                                            <th style="width: 60px;">Cao</th>
                                        </thead>
                                    </table>
                                </th>
                                <th width="5%"><span>Số lượng</span></th>
                                <th><span>Đơn giá (VNĐ)</span></th>
                                <th><span>Thành tiền</span></th>
                            </tr>
                        </thead>
                        <tbody class="body-formular">
                            @if(sizeof($data) > 0)
                            @foreach($data as $v)
                            <tr>
                                <td><span class="bordered-radius-item">1</span></td>
                                <td>
                                    <div class="card-item">
                                        <div class="title">{{ $v->name }}</div>
                                    </div>
                                </td>
                                <td><span>{{ $v->options->type == 0 ? 'Chiếc/Gói/Cuộn' : ($v->options->type == 1 ? 'md' : 'm2') }}</span>
                                    <input type="hidden" class="type_{{ $v->id }}" value="{{ $v->options->type }}">
                                </td>
                                <td class="text-right" style="width: 60px;">
                                    <input class="form-control width width_{{ $v->id }}" data-id="{{ $v->id }}" data-row="{{ $v->rowId }}"
                                        type="number" placeholder="Dài" min="0" required
                                        value="{{ $v->options->width }}">
                                    <input type="hidden" class="base_width_{{ $v->id }}"
                                        value="{{ $v->options->width }}">
                                </td>
                                <td class="text-right" style="width: 60px;">
                                    <input class="form-control depth depth_{{ $v->id }}" data-id="{{ $v->id }}" data-row="{{ $v->rowId }}"
                                        type="number" placeholder="Rộng" min="0" required
                                        value="{{ $v->options->depth }}">
                                </td>
                                <td class="text-right" style="width: 60px;">
                                    <input class="form-control height height_{{ $v->id }}" data-id="{{ $v->id }}" data-row="{{ $v->rowId }}"
                                        type="number" placeholder="Cao" min="0" required
                                        value="{{ $v->options->height }}">
                                    <input type="hidden" class="base_height_{{ $v->id }}"
                                        value="{{ $v->options->height }}">
                                </td>
                                <td class="text-right">
                                    <span class="qty_{{ $v->id }}">{{ $v->qty }}</span>
                                </td>
                                <td class="text-right">
                                    <span>{{ number_format($v->price) }}</span>
                                    <input type="hidden" class="price_{{ $v->id }}" value="{{ $v->price }}">
                                </td>
                                <td class="text-right">
                                <span class="subtotal subtotal_{{ $v->id }}" data-price="{{ $v->subtotal }}">{{ number_format($v->subtotal) }}</span>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            <tr>
                                <td class="text-right" colspan="11"><span><strong>Tổng chi phí: </strong>
                                        <span class="total">{{ $total }}</span> VNĐ</span>
                                    <input type="hidden" class="order_total" value="{{ str_replace(",","",substr($total, 0, strpos($total, "."))) }}">
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col align-self-start text-left"><a class="button-bordered"
                        href="{{ route('site.cart.index') }}"><i class="fa fa-angle-double-left"></i> Quay lại danh mục
                        sản phẩm</a></div>
                <div class="col align-self-end text-right"><a class="button-bordered" rel="nofollow"
                        href="#form-contact" data-toggle="modal" data-target="#formContact">Gửi cho quản trị viên <i
                            class="fa fa-angle-double-right"></i></a></div>
            </div>
            <div class="modal fade" id="formContact" tabindex="-1" aria-labelledby="formContactLabel" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header"><button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="register-panel">
                                <div class="header">
                                    <h1 class="title text-uppercase">Gửi thông tin cho quản trị viên</h1>
                                </div>
                                <form action="" type="Post" class="submit-order">
                                    <div class="form-group row justify-content-center">
                                        <label class="col-auto col-form-label icon-form-label"><span
                                                class="material-icons">person</span><span class="isMobile">Họ
                                                tên</span></label>
                                        <div class="col">
                                        <input class="form-control name" name="name" @if($isActive) readonly @endif placeholder="Nhập họ tên..." value="{{ auth()->check() ? $user->name : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <label class="col-auto col-form-label icon-form-label"><span
                                                class="material-icons">mail_outline</span><span
                                                class="isMobile">Email</span></label>
                                        <div class="col">
                                            <input class="form-control email" name="email" type="email" @if($isActive) readonly @endif placeholder="Nhập email..." value="{{ auth()->check() ? $user->email : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <label class="col-auto col-form-label icon-form-label"><span
                                                class="material-icons">phone_in_talk</span><span class="isMobile">Điện
                                                thoại</span></label>
                                        <div class="col">
                                            <input class="form-control phone" name="phone" @if($isActive) readonly @endif placeholder="Nhập số điện thoại..." value="{{ auth()->check() ? $user->phone : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <div class="col">
                                            <div>
                                                <button class="btn btn-primary has-spinner" type="submit">Gửi dự toán</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function () {
        $(document).on('click', '.btn_remove_cart', function () {
            var id = $(this).data('id');
            var url = BASE_URL + '/cart/remove/' + id;
            var cart_item = $(this);
            $.post(url, function (res) {
                $('.cart-product').html(res.html);
                cart_item.parent().parent().remove();
                // init.notyPopup(res.mess, 'success');
            });
        })

        $(document).on('change', '.width, .height, .depth', function(){
            // var row = $(this).data('row');
            var id = $(this).data('id');
            var width = $('.width_' + id).val() / 1000;
            var height = $('.height_' + id).val() / 1000;
            var depth = $('.depth_' + id).val() / 1000;
            var type = $('.type_' + id).val();
            var price = $('.price_' + id).val();
            var base_width = $('.base_width_' + id).val() / 1000;
            var base_height = $('.base_height_' + id).val() / 1000;
            // console.log(width, height, type, price, base_width, base_height);
            var qty = 1;
            if (type == 0) {
                qty = Math.ceil(height / base_height);
            } else if (type == 1) {
                qty = width / base_width;
            } else if (type == 2) {
                qty = (width * height) / (base_width * base_height);
            }
            var qty_show = Math.round(qty * 10) / 10;
            var subtotal = price * qty_show;
            $('.qty_' + id).text(qty_show);
            $('.subtotal_' + id).text(formatNumber(subtotal));
            $('.subtotal_' + id).data('price', subtotal);
            var total = 0;
            $('.subtotal').each(function(v, i){
                total += $(this).data('price');
            })
            var isActive = {!! json_encode($isActive) !!};
            total = isActive ? total*0.9 : total;
            $('.total').text(formatNumber(total));
            var url = BASE_URL + '/cart/update/'+id+'/'+qty_show;
            var data = {width: width*1000, height: height*1000, depth: depth*1000}
            $.post(url, data, function(res){
                $('.cart-product').html(res.html);
            })
            
        })

        $(".submit-order").submit(function (e) {
            
            //prevent Default functionality
            e.preventDefault();

            //get the action-url of the form
            var actionurl = BASE_URL + '/cart/submitOrder';

            //do your own request an handle the results
            $.ajax({
                url: actionurl,
                type: 'post',
                // dataType: 'application/json',
                data: $(".submit-order").serialize(),
                beforeSend: function() {
                    $('.has-spinner').buttonLoader('start');
                },
                success: function (res) {
                    $('.has-spinner').buttonLoader('stop');
                    if(res.success == 1){
                        init.notyPopup(res.mess, 'success');
                        $('#formContact').modal('hide');
                        setTimeout(function(){
                            window.location.href = BASE_URL;
                        }, 3000);
                    } else {
                        init.notyPopup('Có lỗi xảy ra', 'error');
                    }
                },
                error: function(res){
                    $('.has-spinner').buttonLoader('stop');
                    init.notyPopup('Có lỗi xảy ra', 'error');
                }
            });

        });
    })

    function formatNumber(number) {
        number = number.toFixed(2) + '';
        x = number.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

</script>
@endsection
