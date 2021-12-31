<div class="ps-home-banner ps-home-banner--1">
    <div class="ps-container">
        <div class="ps-section__left">
            <div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
                @if(!empty($sliders))
                    @foreach($sliders as $item)
                        <div class="ps-banner bg--cover" data-background="{{ $item['image'] }}">

                        </div>
                    @endforeach
                @endif

                <div class="ps-banner bg--cover" data-background="img/slider/home-1/slide-2.jpg"><a class="ps-banner__overlay" href="shop-default.html"></a></div>
                <div class="ps-banner bg--cover" data-background="img/slider/home-1/slide-3.jpg"><a class="ps-banner__overlay" href="shop-default.html"></a></div>
            </div>
        </div>
        <div class="ps-section__right">
            @if(!empty($saleOff))
                <div class="row">
                    @foreach($saleOff as $item)
                        <div class="col-md-12 col-xs-12">
                            <div class="mf-banner-small has-img" @if(!empty($item['color'])) style="background-color: '{{$item['color']}}'" @endif >
                                <div class="b-image">{!! get_image_tag($item['image'], 'full') ?? '' !!}</div>
                                <a class="link" href="{{$item['link'] ?? '#'}}"></a>
                                <div class="box-price">
                                    <span class="s-price">{{$item['number'] ?? ''}}<br> OFF</span>
                                </div>
                                <div class="banner-content">
                                    <h2 class="box-title">
                                        {!! clean($item['title'] ?? '') !!}
                                    </h2>
                                    <p class="desc">
                                        {!! clean($item['sub_title'] ?? '') !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a class="ps-collection" href="#">
                            <img src="img/slider/home-1/promotion-1.jpg" alt="">
                        </a>
                    @endforeach
                </div>
            @endif

            <a class="ps-collection" href="#">
                <img src="img/slider/home-1/promotion-2.jpg" alt="">
            </a>
        </div>
    </div>
</div>

<div class="bravo_BannerHome1">
    <div class="martfury-container">
        <div class="row">
            <div class="col-sm-12 col-lg-9 col-xs-12 banner-big">
                <div class="bravo-home-sliders">
                    @if(!empty($sliders))
                        @foreach($sliders as $item)
                            <div class="slotholder">
                                {!! get_image_tag($item['image'], 'full') !!}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 col-xs-12 banner-small">
                @if(!empty($saleOff))
                    <div class="row">
                        @foreach($saleOff as $item)
                            <div class="col-md-12 col-xs-12">
                                <div class="mf-banner-small has-img" @if(!empty($item['color'])) style="background-color: '{{$item['color']}}'" @endif >
                                    <div class="b-image">{!! get_image_tag($item['image'], 'full') ?? '' !!}</div>
                                    <a class="link" href="{{$item['link'] ?? '#'}}"></a>
                                    <div class="box-price">
                                        <span class="s-price">{{$item['number'] ?? ''}}<br> OFF</span>
                                    </div>
                                    <div class="banner-content">
                                        <h2 class="box-title">
                                            {!! clean($item['title'] ?? '') !!}
                                        </h2>
                                        <p class="desc">
                                            {!! clean($item['sub_title'] ?? '') !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
