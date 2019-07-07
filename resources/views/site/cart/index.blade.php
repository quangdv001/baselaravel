@extends('site.layout.main')
@section('title')
Giỏ hàng
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
                        <li><a href="{{ route('site.article.index',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->name }}</a></li>
                        @elseif($v->type == 2)
                        <li><a href="{{ route('site.product.list',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->name }}</a></li>
                        @elseif($v->type == 3)
                        <li><a href="{{ route('site.article.list',['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->name }}</a></li>
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
        <div class="section section-subpage section-shopcart-page d-flex align-items-center">
          <div class="container text-center">
            <div class="shopcart-panel">
              <div class="block-title underline">
                <h1 class="title solid-color text-uppercase"><span>Giỏ hàng</span></h1>
              </div>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Danh mục</th>
                    <th>Tên sản phẩm</th>
                    <th>Hành động</th>
                  </tr>
                </thead>
                <tbody>
                    @if(sizeof($data) > 0)
                        @foreach($data as $v)
                        
                        <tr>
                          <td>{{ $v->options->category }}</td>
                          <td>{{ $v->name }}</td>
                          <td class="text-right">
                            <button class="btn btn-raised btn-danger btn_remove_cart" data-id={{ $v->rowId }}>Xóa</button>
                          </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
              </table>
            </div><a class="button-bordered" href="{{ route('site.cart.payment') }}">Bảng dự trù chi phí sản phẩm đã chọn <i class="fa fa-angle-double-right"></i></a>
          </div>
        </div>
      </div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function(){
        $(document).on('click', '.btn_remove_cart', function(){
            var id = $(this).data('id');
            var url = BASE_URL + '/cart/remove/' + id;
            var cart_item = $(this);
            $.post(url, function(res){
                $('.cart-product').html(res.html);
                cart_item.parent().parent().remove();
                // init.notyPopup(res.mess, 'success');
            });
        })
    })
</script>
@endsection
