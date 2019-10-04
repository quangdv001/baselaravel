<footer class="footer">
    <div class="footer-main">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div><a class="title"><img src="{{ asset('assets/images/logo.png') }}" alt="Kênh thông tin dự án, giao dịch bất động sản trên toàn quốc." style="max-width: 175px;"/></a></div><br/>
            <div>
              <p>@if (isset($listSocial['description-logo'])) {{$listSocial['description-logo']}} @endif</p>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-3">
              @if(sizeof($pagesFooter) > 0)
                <ul class="list-group list-group-flush">
                  @foreach($pagesFooter as $k => $v)
                  @if ($k < 4)
                  <li><a href="{{ route('site.home.category',['slugDetail' => $v->slug]) }}">{{ $v->title}}</a></li>
                  @endif
                  @endforeach
                </ul>
              @endif
              </div>
              <div class="col-sm-3">
                @if(sizeof($pagesFooter) > 0)
                  <ul class="list-group list-group-flush">
                    @foreach($pagesFooter as $k => $v)
                    @if ($k > 3)
                    <li><a href="{{ route('site.home.category',['slugDetail' => $v->slug]) }}">{{ $v->title}}</a></li>
                    @endif
                    @endforeach
                  </ul>
                @endif
                </div>
              <div class="col-sm-3">
                <ul class="list-group list-group-flush">
                  <li><a href="tell:@if (isset($listSocial['phone'])) {{$listSocial['phone']}} @endif"><i class="material-icons">phone_in_talk</i>@if (isset($listSocial['phone'])) {{$listSocial['phone']}} @endif</a></li>
                  <li><a href="tell:@if (isset($listSocial['phone'])) {{$listSocial['phone']}} @endif"><i class="material-icons">phone_in_talk</i>@if (isset($listSocial['phone'])) {{$listSocial['phone']}} @endif</a></li>
                  <li><a href="mailto:@if (isset($listSocial['email'])) {{$listSocial['email']}} @endif"><i class="material-icons">mail_outline</i>@if (isset($listSocial['email'])) {{$listSocial['email']}} @endif</a></li>
                </ul>
              </div>
              <div class="col-sm-3">
                <div>
                  <p>Liên kết mạng xã hội:</p>
                  <div class="social-icon"><a href="@if (isset($listSocial['facebook'])) {{$listSocial['facebook']}} @endif"><i class="fab fa-facebook-f"></i></a>
                  </div>
                  <div class="social-icon"><a href="@if (isset($listSocial['google_plus'])) {{$listSocial['google_plus']}} @endif"><i class="fab fa-google-plus-g"></i></a>
                  </div>
                  <div class="social-icon"><a href="@if (isset($listSocial['twitter'])) {{$listSocial['twitter']}} @endif"><i class="fab fa-twitter"></i></a>
                  </div>
                  <div class="social-icon"><a href="@if (isset($listSocial['youtube'])) {{$listSocial['youtube']}} @endif"><i class="fab fa-youtube"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="copyright">&copy; Copyright 2019. CHK.VN - Website thông tin dự án, giao dịch bất động sản.</div>
    </div>
  </footer>
