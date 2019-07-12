@extends('site.layout.main')
@section('title')
Đặt vé
@endsection
@section('content')
<div class="main">
    <div class="subpage-cover"
        style="background: #2d71a2 url({{ asset('public/assets/site/themes/assets/images/subpage-cover.jpg') }}) no-repeat center top/ auto 100%">
        <div class="page-title d-flex align-items-center justify-content-center"><span>@lang('booking.booking')</span></div>
    </div>
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <ol class="breadcrumb breadcrumb-dot">
                    <li class="breadcrumb-item"><i class="material-icons">home</i><a href="index.html"
                            title="Trang chủ">Trang chủ</a></li>
                    {{-- <li class="breadcrumb-item"><a href="#sublink" title="Title link">Sub page</a></li> --}}
                    <li class="breadcrumb-item active"><span>@lang('booking.book')</span></li>
                </ol>
            </div>
        </div>
    </div>
    <div class="section-main">
        <div class="container">
            <div class="row">
                <div class="col col-sm-9 border-sm-right">
                    <div class="row">
                        <div class="col">
                            <div class="detail-post">
                                <h1 class="page-title"><a href="#">@lang('booking.booking')</a></h1>
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <form class="form form-services" id="bookingform" method="POST"
                                    action="{{ route('site.home.postBooking') }}">
                                    @csrf
                                    <div class="form-services-layout">
                                        <div class="form-header">
                                            <div class="title">@lang('booking.booking')</div>
                                            <div class="subtitle">@lang('booking.contact')</div>
                                        </div>

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10 form-group">
                                                    <div class="toggle-switch">
                                                        <input class="switch-toggle" id="khuhoi" type="checkbox"
                                                            name="is_round_trip"  value="1" @if(isset($data['is_round_trip']))
                                                            checked @endif>
                                                        <label class="switch-viewport" for="khuhoi">
                                                            <div class="switch-slider">
                                                                <div class="switch-button"> </div>
                                                                <div class="switch-content left"><span>@lang('booking.way1')</span>
                                                                </div>
                                                                <div class="switch-content right"><span>@lang('booking.way2')</span>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="bmd-label-floating" for="item-form-0">@lang('booking.from')</label>
                                                    <select class="form-control" name="start_id">
                                                        @if(sizeof($province) > 0)
                                                        @foreach($province as $k => $v)
                                                        <option value="{{ $k }}" @if(isset($data['start_id']) &&
                                                            $data['start_id']==$k) selected @endif>{{ $v }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select><span class="float-icon"><i
                                                            class="material-icons">room</i></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="bmd-label-floating" for="item-form-1">@lang('booking.to')</label>
                                                    <select class="form-control" name="end_id">
                                                        @if(sizeof($province) > 0)
                                                        @foreach($province as $k => $v)
                                                        <option value="{{ $k }}" @if(isset($data['end_id']) &&
                                                            $data['end_id']==$k) selected @endif>{{ $v }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select><span class="float-icon"><i
                                                            class="material-icons">room</i></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="bmd-label-floating" for="item-form-2">@lang('booking.amount')</label>
                                                    <input class="form-control" type="text" id="item-form-2" name="qty"
                                                        value="{{ isset($data['qty']) ? $data['qty'] : old('qty') }}" /><span
                                                        class="float-icon"><i
                                                            class="material-icons">supervisor_account</i></span>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="bmd-label-floating" for="start-date">@lang('booking.start')</label>
                                                    <input class="form-control datepicker" type="text" id="start-date"
                                                        name="start_time" data-date-format="DD, MM d"
                                                        value="{{ isset($data['start_time']) ? $data['start_time'] : old('start_time') }}" />
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="bmd-label-floating" for="end-date">@lang('booking.end')</label>
                                                    <input class="form-control datepicker" type="text" id="end-date"
                                                        name="end_time" data-date-format="DD, MM d"
                                                        value="{{ isset($data['end_time']) ? $data['end_time'] : old('end_time') }}" />
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="bmd-label-floating" for="item-form-6">@lang('booking.note')</label>
                                                    <input class="form-control" type="text" id="item-form-6" name="note"
                                                        value="{{ isset($data['note']) ? $data['note'] : old('note') }}" /><span
                                                        class="float-icon"><i
                                                            class="material-icons">event_seat</i></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="step2" style="display:block">
                                        <div class="module-title"><a href="#">@lang('booking.note_info')</a></div>
                                        <div class="form-services-layout">
                                            <form class="form form-services">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="form-group col-md-4">
                                                            <label class="bmd-label-floating" for="item-form-0">@lang('booking.name')</label>
                                                            <input class="form-control" type="text" name="name" value="{{ old('name') }}"
                                                                placeholder="Nhập họ tên" id="item-form-0" /><span
                                                                class="float-icon"><i
                                                                    class="material-icons">person</i></span>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="bmd-label-floating"
                                                                for="item-form-1">@lang('booking.email')</label>
                                                            <input class="form-control" type="text"
                                                                placeholder="Nhâp email" name="email" value="{{ old('email') }}"
                                                                id="item-form-1" /><span class="float-icon"><i
                                                                    class="material-icons">mail</i></span>
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label class="bmd-label-floating" for="item-form-2">@lang('booking.phone')</label>
                                                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}"
                                                                placeholder="Nhập số điện thoại"
                                                                id="item-form-2" /><span class="float-icon"><i
                                                                    class="material-icons">phone</i></span>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label class="bmd-label-floating" for="item-form-3">@lang('booking.address')</label>
                                                            <input class="form-control" type="text" name="address" value="{{ old('address') }}"
                                                                placeholder="Nhập địa chỉ" id="item-form-3" /><span
                                                                class="float-icon"><i
                                                                    class="material-icons">room</i></span>
                                                        </div>
                                                        {{-- <div class="form-group col-md-12">
                                                        <label class="bmd-label-floating" for="item-form-4">Thông
                                                            điệp</label>
                                                        <textarea class="form-control" type="textarea" rows="6"
                                                            placeholder="Nhập thông tin" id="item-form-4"></textarea>
                                                    </div> --}}
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="module-title"><a href="#">@lang('booking.payment')</a></div>
                                        <div class="form-services-layout">
                                            <div class="form-check">
                                                <input class="form-check-input" id="paymentmethod1" type="radio"
                                                    name="payment_method" value="0" checked="">
                                                <label class="form-check-label" for="paymentmethod1">@lang('booking.payment_1')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="paymentmethod2" type="radio"
                                                    name="payment_method" value="1" @if(old('payment_method') == 1) checked @endif>
                                                <label class="form-check-label" for="paymentmethod2">@lang('booking.payment_2')</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" id="paymentmethod3" type="radio"
                                                    name="payment_method" value="2" @if(old('payment_method') == 2) checked @endif>
                                                <label class="form-check-label" for="paymentmethod3">@lang('booking.payment_3')</label>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button class="btn btn-primary text-uppercase"
                                                    onclick="openNextStep(this)">@lang('booking.book')</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    function openNextStep(e) {
                                        console.log('openNextStep', e);
                                        document.querySelector('.step2').style.display = 'block'
                                    }

                                </script>
                                <ul class="list-categories">
                                    <li><a href="#address:"> @lang('footer.footer_1')</a></li>
                                    <li><a>  @lang('footer.footer_2')</a></li>
                                    <li><a href="tell:0243.9429918"> <i class="material-icons">phone_in_talk</i>
                                        @lang('footer.footer_3')</a></li>
                                    <li><a href="tell: 0904.101.488"> <i class="material-icons">phone_in_talk</i>  @lang('footer.footer_4')</a></li>
                                    <li><a href="mailto:booking@livitrans.com"> <i
                                                class="material-icons">mail_outline</i>  @lang('footer.footer_5')</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 sidebar">
                    {{-- <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Danh mục</a></h3>
                        <ul class="list-categories">
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Đặt vé</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Du lịch</a></li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Hủy chuyến</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Gửi hành lý</a>
                            </li>
                            <li><a href="#link"><i class="material-icons list-style">chevron_right</i>Ký gửi</a></li>
                        </ul>
                    </div> --}}
                    @if(sizeof($article) > 0)
                    <div class="list-post-aside">
                        <h3 class="module-title"><a href="#"> @lang('booking.article')</a></h3>
                        @foreach($article as $v)
                        @if($v->title)
                        <div class="news-post line-bottom small-post"><a class="news-post-image-link"
                                href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">
                                <figure class="image-container rectangle-image">
                                    <div class="featured-image-overlay"><span class="featured-image-icon"><i
                                                class="fa fa-camera"></i></span></div><img class="img-responsive"
                                        src="{{ $v->img }}" alt="title alt" />
                                </figure>
                            </a>
                            <div class="news-post-content">
                                <h3 class="post-title title"><a class="news-post-link"
                                        href="{{ route('site.article.detail', ['id' => $v->id, 'slug' => $v->slug]) }}">{{ $v->title }}</a>
                                </h3>
                                <div class="post-meta-container"><span class="post-meta-item"><i
                                            class="far fa-clock"></i> {{ $v->created_at->format('d/m/Y') }}</span><span
                                        class="post-meta-item"><i class="fa fa-user-check"></i><a href="#admin">
                                            Admin</a></span></div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                    {{-- <div class="list-post-aside">
                        <h3 class="module-title"><a href="#">Liên kết website</a></h3>
                        <ul class="list-categories">
                            <li><a href="http://vinacomin.vn"><i class="material-icons list-style">chevron_right</i>Tập
                                    Đoàn CN Than - KSản VN</a></li>
                            <li><a href="http://ratraco.vn/"><i class="material-icons list-style">chevron_right</i>CTy
                                    CP Vận Tải & TM RATRACO</a></li>
                        </ul>
                    </div>
                    <a class="banner-add" href="#banner"><img
                            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bd33c405c632.jpg"
                            alt="banner title" /></a><a class="banner-add" href="#banner"><img
                            src="http://adi.admicro.vn/adt/adn/2018/10/300x2-adx5bb48fba328c6.jpg"
                            alt="banner title" /></a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')

@endsection
