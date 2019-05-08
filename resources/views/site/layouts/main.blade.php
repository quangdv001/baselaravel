{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('site.layouts.header')
    @yield('content')
    @include('site.layouts.footer')
</body>
</html> --}}

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- Bootstrap fonts and icons-->
    <link rel="stylesheet" href="./assets/frontend/libs/font-roboto/style.css">
    <link rel="stylesheet" href="./assets/frontend/libs/material-design-icons/css/material-icons.min.css">
    <link rel="stylesheet" href="./assets/frontend/libs/fontawesome5/css/all.css">
    <link rel="stylesheet" href="./assets/frontend/libs/bootstrap-material/css/bootstrap-material-design.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/frontend/libs/owlcarousel2/assets/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/frontend/libs/owlcarousel2/assets/owl.theme.default.min.css" type="text/css">
    <link rel="stylesheet" href="./assets/frontend/css/theme.css" type="text/css">
  </head>
  <body>       
    <div class="page home">
      {{-- HEADER --}}
      @include('site.layouts.header')
      {{-- END HEADER --}}
      <div class="main">
        <div class="section-main">
          <div class="container main-wrapper">      
            <div class="row">
              <div class="col-sm-9 border-sm-right">
                <div class="row main-head">
                  <div class="col-sm-3 border-sm-right">
                    @include('site.components.latestLaws')
                  </div>
                  <div class="col-sm-9">
                    @include('site.components.headerNews')
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-8 border-sm-right">
                    <div class="block">
                      <div class="block-title underline">
                        <h2 class="title solid-color text-uppercase"><span>Tin cho thuê</span></h2>
                      </div>
                      <div class="list-post">
                        <div class="forrent-post line-bottom">
                          <div class="post-content"><a class="news-post-image-link" href="./single_product.html">
                              <figure class="image-container">
                                <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="./assets/images/services_02.png" alt="title alt"/>
                              </figure></a>
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content"><a class="news-post-image-link" href="./single_product.html">
                              <figure class="image-container">
                                <div class="featured-image-overlay"><span class="featured-image-icon"><i class="fa fa-camera"></i></span></div><img class="img-responsive" src="./assets/images/services_02.png" alt="title alt"/>
                              </figure></a>
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                        <div class="forrent-post line-bottom">
                          <div class="post-content">
                            <h3 class="post-title title"><a class="news-post-link" href="./single_product.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></h3>
                            <div class="row">
                              <div class="col rent-attribute"><strong>Giá :</strong><span> 525 triệu</span></div>
                              <div class="col rent-attribute"><strong>Diện tích :</strong><span> 83 m²</span></div>
                              <div class="col rent-attribute"><strong>Quận/huyện :</strong><span> Phú Xuyên</span></div>
                            </div>
                            <div class="post-meta-container"><span class="post-meta-item"><i class="far fa-clock"></i> Th3-27/10/2015</span><span class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin"> Admin</a></span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="block">
                      <div class="block-title underline">
                        <h2 class="title text-uppercase">Dự án mới</h2>
                      </div>
                      <div class="list-course">
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="block gray-block">
                              <div class="cover-image"><img src="./assets/images/services_02.png" alt=""/>
                              </div>
                              <div class="title">
                                <h3><a href="project-detail.html">Dự án title 2</a></h3>
                                <div class="meta-info"><a class="meta-info-item" href="#0">Dự án</a><span class="meta-info-item">22 Dự án</span></div>
                              </div><a class="btn btn-raised btn-md btn-brand" href="#0"><i class="inc-icon inc-play"> </i><span>Xem chi tiết</span></a>
                              <div class="block-info"><a class="meta-info-item" href="project.html">Dự án</a><span class="meta-info-item">22 Dự án</span></div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="block gray-block">
                              <div class="cover-image"><img src="./assets/images/services_03.png" alt=""/>
                              </div>
                              <div class="title">
                                <h3><a href="project-detail.html">Dự án title 3</a></h3>
                                <div class="meta-info"><a class="meta-info-item" href="#0">Dự án</a><span class="meta-info-item">22 Dự án</span></div>
                              </div><a class="btn btn-raised btn-md btn-brand" href="#0"><i class="inc-icon inc-play"> </i><span>Xem chi tiết</span></a>
                              <div class="block-info"><a class="meta-info-item" href="project.html">Dự án</a><span class="meta-info-item">22 Dự án</span></div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="block gray-block">
                              <div class="cover-image"><img src="./assets/images/services_02.png" alt=""/>
                              </div>
                              <div class="title">
                                <h3><a href="project-detail.html">Dự án title 3</a></h3>
                                <div class="meta-info"><a class="meta-info-item" href="#0">Dự án</a><span class="meta-info-item">22 Dự án</span></div>
                              </div><a class="btn btn-raised btn-md btn-brand" href="#0"><i class="inc-icon inc-play"> </i><span>Xem chi tiết</span></a>
                              <div class="block-info"><a class="meta-info-item" href="project.html">Dự án</a><span class="meta-info-item">22 Dự án</span></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    @include('site.components.latestBlock', ['moduleTitle'=>'Tiêu điểm', 'type'=>'thumb', 'news'=>$promotionNews])
                    @include('site.components.latestBlock', ['moduleTitle'=>'Khác', 'type'=>'null', 'news'=>$promotionNews])
                    
                    {{-- <div class="block">
                      <div class="block-title">
                        <div class="module-title solid-color"><a href="#">Khác</a></div>
                        <div class="news-post line-bottom list-style-post small-post">
                          <div class="news-post-content">
                            <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="./single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                          </div>
                        </div>
                        <div class="news-post line-bottom list-style-post small-post">
                          <div class="news-post-content">
                            <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="./single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                          </div>
                        </div>
                        <div class="news-post line-bottom list-style-post small-post">
                          <div class="news-post-content">
                            <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="./single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                          </div>
                        </div>
                        <div class="news-post line-bottom list-style-post small-post">
                          <div class="news-post-content">
                            <div class="post-title title"><i class="list-icon fas fa-circle"></i><a class="news-post-link" href="./single.html">Lorem Ipsum là gì, Tại sao lại sử dụng nó?</a></div>
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    <a href="#" style="display:block"><img src="https://file4.batdongsan.com.vn/2019/03/18/RUFz0fap/20190318111542-274f.jpg" alt="" width="100%" height="630px"></a>
                  </div>
                </div>
              </div>
              <div class="col-sm-3 sidebar">
                @include('site.layouts.sidebar')
              </div> <!-- sidebar -->
            </div>
          </div>
        </div>
      {{-- PARTNERS --}}
      @include('site.layouts.partners', ['partners'=>$partners])
      {{-- END PARTNERS --}}
        <div class="section-gap banner-text" style="    background: #ccc url(https://syntec-numerique.fr/sites/default/files/styles/medium/public/Image/finance-syntec-02-02-2017-2.jpg?itok=sXt3wLLF) no-repeat center top / 100% 600%;">
          <div class="container">
            <div class="block-title">
              <h2 class="title">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả</h2>
            </div>
            <p class="text-block">Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Được dùng vào việc trình bày và dàn trang phục vụ cho in ấn.</p>
          </div>
        </div>
      </div>
      {{-- FOOTER --}}
      @include('site.layouts.footer')
      {{-- END FOOTER --}}
    </div>
    <script src="./assets/frontend/libs/jquery/jquery-3.2.1.min.js"></script>
    <script src="./assets/frontend/libs/popper/umd/popper.js"></script>
    <script src="./assets/frontend/libs/bootstrap-material/js/bootstrap-material-design.min.js"></script>
    <script src="./assets/frontend/libs/owlcarousel2/owl.carousel.min.js"></script>
    <script src="./assets/frontend/libs/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="./assets/frontend/js/main.js"></script>
  </body>
</html>