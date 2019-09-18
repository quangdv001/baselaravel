<footer class="footer">
    <div class="footer-main">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div><a class="title"><img src="{{ asset('assets/images/logo.png') }}" alt="Kênh thông tin dự án, giao dịch bất động sản trên toàn quốc." style="max-width: 175px;"/></a></div><br/>
            <div>
              @if ($listSocial['description-logo'])
                <p>{{$listSocial['description-logo']}}</p>                  
              @endif
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
                  <li><a href="tell:{{$listSocial['phone']}}"><i class="material-icons">phone_in_talk</i> {{$listSocial['phone']}}</a></li>
                  <li><a href="tell:{{$listSocial['phone']}}"><i class="material-icons">phone_in_talk</i> {{$listSocial['phone']}}</a></li>
                  <li><a href="mailto:{{$listSocial['email']}}"><i class="material-icons">mail_outline</i> {{$listSocial['email']}}</a></li>
                </ul>
              </div>
              <div class="col-sm-3">
                <div>
                  <p>Liên kết mạng xã hội:</p>
                  <div class="social-icon"><a href="{{$listSocial['facebook']}}"><i class="fab fa-facebook-f"></i></a>
                  </div>
                  <div class="social-icon"><a href="{{$listSocial['google_plus']}}"><i class="fab fa-google-plus-g"></i></a>
                  </div>
                  <div class="social-icon"><a href="{{$listSocial['twitter']}}"><i class="fab fa-twitter"></i></a>
                  </div>
                  <div class="social-icon"><a href="{{$listSocial['youtube']}}"><i class="fab fa-youtube"></i></a>
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