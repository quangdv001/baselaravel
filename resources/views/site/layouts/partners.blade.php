
@if($partners)
    <div class="section-partners">
        <div class="container">
            <div class="row justify-content-md-center">
            <div class="col-sm-12"><br>
                <div class="partners">
                <div class="partners-carousel owl-carousel owl-theme">
                    @foreach ($partners as $item)
                        <a class="partner-item" href="#partner"><img src="{{ $item->img }}" alt="#{{ $item->title }}"/></a>
                    @endforeach
                </div>
                </div><br>
            </div>
            </div>
        </div>
    </div>
@endif