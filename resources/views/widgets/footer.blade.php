<footer class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="text-center">
                        <a class="title ">
                            <img src="{{$dataInfo['logo']}}" style="max-width: 175px;"
                                 alt="{{$dataInfo['name']}}"/>
                        </a>
                    </div>
                    <div>
                        <ul>
                            <li style="text-align:center">
                                <span style="font-size:14px">
                                    <strong>{{$dataInfo['name']}}</strong>
                                    Giấy chứng nhận
                                    <strong> ĐKKD số {{$dataInfo['certificate_number']}}</strong>
                                    do Phòng ĐKKD -&nbsp;{{$dataInfo['certificate_text']}}
                                </span>
                            </li>
                            <li style="text-align:center">
                                <span style="font-size:12px"><strong>Địa chỉ</strong>:
                                    {{$dataInfo['address']}}
                                </span>
                            </li>
                            <li style="text-align:center"><strong>Số điện thoại</strong>:{{$dataInfo['phone']}}</li>
                            <li style="text-align:center"><strong>Email</strong>: {{$dataInfo['email']}}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="row">
{{--                        <div class="col-sm-3">--}}
{{--                            <ul class="list-group list-group-flush">--}}
{{--                                <li><a href="#link">Hướng dẫn</a></li>--}}
{{--                                <li><a href="#link">Tài liệu</a></li>--}}
{{--                                <li><a href="#link">Chính sách</a></li>--}}
{{--                                <li><a href="#link">Hỗ trợ</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <ul class="list-group list-group-flush">--}}
{{--                                <li><a href="#link">Hướng dẫn</a></li>--}}
{{--                                <li><a href="#link">Tài liệu</a></li>--}}
{{--                                <li><a href="#link">Chính sách</a></li>--}}
{{--                                <li><a href="#link">Hỗ trợ</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <ul class="list-group list-group-flush">--}}
{{--                                <li><i class="material-icons">phone_in_talk</i> 123 456--}}
{{--                                    789--}}
{{--                                </li>--}}
{{--                                <li><a href="tell:123 456 798"><i class="material-icons">phone_in_talk</i> 123 456--}}
{{--                                        798</a></li>--}}
{{--                                <li><a href="mailto:email@domail.com"><i class="material-icons">mail_outline</i>--}}
{{--                                        email@domail.com</a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-3">--}}
{{--                            <div>--}}
{{--                                <p>Liên kết mạng xã hội:</p>--}}
{{--                                <div class="social-icon"><a><i class="fab fa-facebook-f"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="social-icon"><a><i class="fab fa-google-plus-g"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="social-icon"><a><i class="fab fa-twitter"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="social-icon"><a><i class="fab fa-youtube"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @if(!empty($dataFooter))
                            @foreach($dataFooter as $group)
                                <div class="col-sm-3">
                                    <ul class="list-group list-group-flush">
                                        @if(!empty($group['list']))
                                            @foreach($group['list'] as $item)
                                                @switch($item['type'])
                                                    @case(0)
                                                    <li>
                                                        <a href="{{asset('').$item['page']['slug']}}">{{$item['title']}}</a>
                                                    </li>
                                                    @break
                                                    @case(1)
                                                    <li>{!! $item['info']['content'] !!}</li>
                                                    @break
                                                    @case(2)
                                                    <li><img src="{{$item['img']}}" alt="" class="w-100"></li>
                                                    @break
                                                    @case(3)
                                                    <li><p>{{$item['content']}}</p></li>
                                                    @break
{{--                                                    @case(4)--}}
{{--                                                    <li>--}}
{{--                                                        @foreach($item['social'] as $i)--}}
{{--                                                            <div class="social-icon">--}}
{{--                                                                <a>{!!  $i['icon']!!}</a>--}}
{{--                                                            </div>--}}
{{--                                                        @endforeach--}}
{{--4                                                    </li>--}}
{{--                                                    @break--}}
                                                    @default
                                                @endswitch
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">&copy; Copyright 2019. CHKVIETNAM.VN - Website thông tin dự án, giao dịch bất động sản.
        </div>
    </div>
</footer>
