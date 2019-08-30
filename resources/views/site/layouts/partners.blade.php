
@if(isset($exchangePartnerAdvertise) && count($exchangePartnerAdvertise) > 0)
    <div class="section-partners">
        <div class="container">
            <div class="row justify-content-md-center">
            <div class="col-sm-12"><br>
                <div class="partners">
                <div class="partners-carousel owl-carousel owl-theme">
                    @foreach ($exchangePartnerAdvertise as $item)
                    @if (isset($item['img'])) 
                        <a class="partner-item landscape_image" href="{{ route('site.home.showDetail',['slugCategory' => $categoryExchange->slug, 'slugDetail' => $item->slug]) }}"><img src="{{ $item['img'] }}" alt="{{ $item['title'] }}"/></a>
                    @endif
                    @endforeach
                </div>
                </div><br>
            </div>
            </div>
        </div>
    </div>
@endif