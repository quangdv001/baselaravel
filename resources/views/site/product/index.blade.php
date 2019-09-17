@extends('site.layout.main')
@section('title')
{{ $cate->name }}
@endsection
@section('content')
<div class="section-dark"
    style="background: #ccc url({{ asset('public/assets/site/themes/assets/images/slide-bg.png') }}) center top /auto 100%;margin-bottom: 15px;">
    <div class="container">
        <div class="row align-items-center cover-slide justify-content-md-center">
            <div class="col-sm-12">
                <div class="text-center">
                    <div class="block-title">
                        <h2 class="title sevices-title-nomarl"><span>KHÔNG GIAN SỐNG LÀ ĐẦU TƯ NỀN TẢNG</span></h2>
                    </div>
                    <div class="sevices-title-large">CHO NHỮNG THÀNH CÔNG NỐI TIẾP VỀ SAU</div>
                </div>
                @if(sizeof($category) > 0)
                <div class="row services-blog">
                    @foreach($category as $v)
                    @if($v->type == 0)
                    <div class="col-12 col-sm-3">
                        <a class="block service-blog text-center @if($cate->id == $v->id) active @endif"
                            href="{{ strval($v->url) != '' ? url(strval($v->url)) : '#' }}">
                            <div class="cover-icon"><img src="{{ $v->img }}" alt="" />
                            </div>
                            <div class="title">
                                <h3><span>{{ $v->name }}</span></h3>
                            </div>
                        </a>
                    </div>
                    @elseif($v->type == 1)
                    <div class="col-12 col-sm-3">
                        <a class="block service-blog text-center @if($cate->id == $v->id) active @endif"
                            href="{{ route('site.article.index',['id' => $v->id, 'slug' => $v->slug]) }}">
                            <div class="cover-icon"><img src="{{ $v->img }}" alt="" />
                            </div>
                            <div class="title">
                                <h3><span>{{ $v->name }}</span></h3>
                            </div>
                        </a>
                    </div>
                    @elseif($v->type == 2)
                    <div class="col-12 col-sm-3">
                        <a class="block service-blog text-center @if($cate->id == $v->id) active @endif"
                            href="{{ route('site.product.list',['id' => $v->id, 'slug' => $v->slug]) }}">
                            <div class="cover-icon"><img src="{{ $v->img }}" alt="" />
                            </div>
                            <div class="title">
                                <h3><span>{{ $v->name }}</span></h3>
                            </div>
                        </a>
                    </div>
                    @elseif($v->type == 3)
                    <div class="col-12 col-sm-3">
                        <a class="block service-blog text-center @if($cate->id == $v->id) active @endif"
                            href="{{ route('site.article.list',['id' => $v->id, 'slug' => $v->slug]) }}">
                            <div class="cover-icon"><img src="{{ $v->img }}" alt="" />
                            </div>
                            <div class="title">
                                <h3><span>{{ $v->name }}</span></h3>
                            </div>
                        </a>
                    </div>
                    @endif

                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="main">
    <div class="section section-subpage">
        <div class="container">
            <div class="text-center">
                <div class="block-title underline">
                    <h1 class="title solid-color text-uppercase"><span>Sản phẩm dành cho {{ $cate->name }}</span></h1>
                </div>
                <div class="subtitle">Click vào title, hình ảnh hoặc hình icon kính lúp của từng sản phẩm để xem chi
                    tiết bật lên</div><br><br>
            </div>
            @if(sizeof($data) > 0)
            <div class="row">
                @foreach($data as $v)
                <div class="col-md-3">
                    <div class="block block-media-product">
                        <div class="row">
                            <div class="col-12"><a class="cover-image square-image open_modal" href="javascript:void(0);" data-id="{{ $v->id }}"><img
                                        src="{{ $v->img }}" alt=""></a></div>
                            <div class="col-12 text-center block-content">
                            <h3><a class="title open_modal" href="javascript:void(0);" data-id="{{ $v->id }}">{{ $v->title }}</a></h3>
                                <div class="btn-cart-in">
                                    <ul>
                                        <li><a class="button bg-yellow open_modal" rel="nofollow" href="javascript:void(0);" data-id="{{ $v->id }}"><i
                                                    class="material-icons">search</i></a></li>
                                        <li><a class="button bg-red btn_add_cart" rel="nofollow" href="javascript:void(0)" data-id="{{ $v->id }}"><i
                                                    class="material-icons">shopping_cart</i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                @endforeach
                <!-- Modal product_detail-->
                <div class="modal fade" id="product_detail" tabindex="-1"
                    aria-labelledby="product_detailLabel" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      </div>
                </div>
            </div>
            @endif
            <nav aria-label="Page navigation">
                <div class="d-flex justify-content-center">
                    {{ $data->links() }}
                </div>
              {{-- <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Tiếp</a></li>
              </ul> --}}
            </nav>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>
  $(document).ready(function(){
    $('.open_modal').click(function(){
      var id = $(this).data('id');
      var url = BASE_URL + '/product/detail/' + id;
      $.get(url, function(res){
        $('.modal-dialog').html(res.html);
        
        var sync1 = $(".main-carousel");
        var sync2 = $(".thumb-carousel");
        sync1.owlCarousel({
            loop: false,
            dots: false,
            margin: 20,
            nav: false,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            items: 1
        }).on('changed.owl.carousel', syncPosition);
        var sync2Options = {
            loop: false,
            dots: false,
            margin: 20,
            // autoplay: true,
            // autoplayTimeout: 15000,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            itemss: 3
            // responsive: {
            //     0: {
            //         items: 2,
            //         margin: 15,
            //         nav: false
            //     },
            //     480: {
            //         items: 2,
            //         margin: 15,
            //         nav: false
            //     },
            //     768: {
            //         items: 3,
            //         margin: 15,
            //         nav: false
            //     },
            //     1200: {
            //         items: 3,
            //         margin: 15
            //     },
            //     1400: {
            //         items: 3,
            //         margin: 15
            //     },
            //     1600: {
            //         items: 3,
            //         margin: 15
            //     }
            // }
        };
        var syncedSecondary = true;

        sync2.on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        }).owlCarousel(sync2Options).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            //if set loop to false
            var current = el.item.index;

            //if you disable loop, comment this block
            // var count = el.item.count-1;
            // var current = Math.round(el.item.index - (el.item.count/2) - .5);

            // if(current < 0) {
            //   current = count;
            // }
            // if(current > count) {
            //   current = 0;
            // }

            //end block

            sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
        $('#product_detail').modal();
      })
     
    })

    $(document).on('click', '.btn_add_cart', function(){
      var id = $(this).data('id');
      var url = BASE_URL + '/cart/add/' + id;
      $.post(url, function(res){
        $('#product_detail').modal('hide');
        if(res.success == 1){
          $('.cart-product').html(res.html);
          init.notyPopup(res.mess, 'success');
        } else {
          init.notyPopup(res.mess, 'error');
        }
      });
    })
  })
</script>
@endsection
