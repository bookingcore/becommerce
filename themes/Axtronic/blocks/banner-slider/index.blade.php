<!-- Slider main container -->
@if(!empty($sliders))
<div class="container">
    <div class="banner-slider swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper axtronic-modern-slider ">
            <!-- Slides -->
            @foreach($sliders as $slide)
            <div class="swiper-slide">
                <div class="axtronic-box">
                    <div class="axtronic-box-inner">
                        <div class="slide-bg-wrap axtronic-image">
                            <div class="slide-bg image" style="background-image: url('{{ get_file_url($slide['image']?? false,'full') }}')"></div>
                        </div>
                        <div class="slide-content">
                            <div class="slide-layers">
                                <div class="title-wrap-line">
                                    <div class="sub-title-wrap">
                                        <h4 class="sub-title">{{ $slide['sub_title'] }}</h4>
                                    </div>
                                    <div class="title-wrap">
                                        <h3 class="title">{!! clean($slide['title']) !!}</h3>
                                    </div>
                                </div>
                                <div class="description-wrap">
                                    <div class="description">
                                        <p>{!! clean($slide['sub_text']) !!}</p>
                                    </div>
                                </div>
                                <div class="button-wrap">
                                    <a class="elementor-button" href="{{ $slide['link_shop_now'] }}">
                                        <span class="button-text">{{ $slide['btn_shop_now'] }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           @endforeach
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
</div>

@endif
