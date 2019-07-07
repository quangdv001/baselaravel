<div class="modal-content">
    <div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-5">
                <div class="main-carousel owl-carousel owl-theme">
                    <a class="item" href="#"><img src="{{ $data->img }}" alt=""></a>
                    @if(sizeof($data->images) > 0)
                    @foreach($data->images as $val)
                    <a class="item" href="#"><img src="{{ $val->img }}" alt=""></a>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="col-md-7 product-content">
                <div class="title">{{ $data->title }}</div>
                <div class="product-info">
                    @if($data->style)

                    <div><span class="meta-attributor text-uppercase">Phong cách: </span><span
                            class="meta-value">{{ $data->style }}</span></div>
                    @endif
                    @if($data->color)

                    <div><span class="meta-attributor text-uppercase">Màu sắc: </span><span
                            class="meta-value">{{ $data->color }}</span></div>
                    @endif
                    @if($data->width)
                    <div><span class="meta-attributor text-uppercase">Kích thước: </span><span
                    class="meta-value">{{ $data->width }}{{ $data->depth > 0 ? 'x'.$data->depth : '' }}{{ $data->height > 0 ? 'x'.$data->height: '' }} {{ $data->type == 0 ? 'Chiếc/Gói/Cuộn' : ($data->type == 1 ? 'md' : 'm2') }}</span></div>
                    @endif
                    @if($data->material)
                    <div><span class="meta-attributor text-uppercase">Chất liệu: </span><span
                            class="meta-value">{{ $data->material }}</span></div>
                    @endif
                    @if($data->guarantee)
                    <div><span class="meta-attributor text-uppercase">Bảo hành: </span><span
                            class="meta-value">{{ $data->guarantee }}</span>
                        @endif
                    </div><button type="button" class="btn btn-primary btn_add_cart" data-id="{{ $data->id }}">Thêm vào giỏ
                        hàng</button>
                </div>
                <div class="thumb-carousel owl-carousel owl-theme">
                    <a class="item item-border" href="#"><img src="{{ $data->img }}" alt=""></a>
                    @if(sizeof($data->images) > 0)
                    @foreach($data->images as $val)
                    <a class="item item-border" href="#"><img src="{{ $val->img }}" alt=""></a>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
