<div class="home-one mt30 mt70-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="bc-home-banner main-banner-wrapper home2_main_slider mb30-md">
                    <div class="banner-style-one owl-theme owl-carousel">
                        @foreach($sliders as $slider)
                        <div class="slide slide-one" style="background-image: url({{ get_file_url($slider['image']?? false,'full') }});height: 530px;">
                            <div class="container">
                                <div class="row home-content tac-sm">
                                    <div class="col-lg-12 p0">
                                        <p class="fwb ttu text-thm2">{!! $slider['sub_title'] !!}}</p>
                                        <h3 class="banner-title text-thm2 ttu">{!! $slider['title'] !!}</h3>
                                        <p class="text-thm2 dn-sm">{!! $slider['sub_text'] !!}</p>
                                        <a href="{{ $slider['link_shop_now'] }}" class="btn p0">
                                            <button class="banner-btn btn-thm">{{ $slider['btn_shop_now'] }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- /.main-banner-wrapper -->
            </div>
            @if(!empty($sliders_2))
            <div class="col-lg-4 col-xl-3">
                @foreach($sliders_2 as $slider_2)
                <div class="banner_one home2_style">
                    <div class="thumb"><img src="{{ get_file_url($slider_2['image']?? false,'full') }}" alt="{{ $slider_2['title'] }}"></div>
                    <div class="details style2">
                        <p class="para">{!! $slider_2['sub_title'] !!}</p>
                        <h2 class="title">{{ $slider_2['title'] }} <br>
                            @if(!empty($slider_2['sub_text'])) <span class="text-thm2">{{ $slider_2['sub_text'] }}</span> @endif
                        </h2>
                        <a href="{{ $slider['link_shop_now'] }}" class="shop_btn style2">{{ $slider['btn_shop_now'] }}</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
