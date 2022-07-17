<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/15/2022
 * Time: 5:04 PM
 */
?>
<!-- Slider main container -->
@if(!empty($sliders))
    <div class="banner-slider swiper-container demus-slider-1">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper  ">
            <!-- Slides -->
            @foreach($sliders as $slide)
                <div class="swiper-slide">
                    <div class="demus-box">
                        <div class="demus-box-inner">
                            <div class="slide-bg-wrap demus-image">
                                <div class="slide-bg image" style="background-image: url('{{ get_file_url($slide['image']?? false,'full') }}')"></div>
                            </div>
                            <div class="slide-content {{$slide['position'] }} {{ !empty($slide['is_dark']) ? 'dark' : 'light' }}">
                                <div class="slide-layers  d-flex justify-content-center">
                                    @if($slide['sub_title'])
                                        <h4 class="sub-title ">{{ $slide['sub_title'] }}</h4>
                                    @endif
                                    @if($slide['title'])
                                            <h2 class="title">{!! clean($slide['title']) !!}</h2>
                                    @endif
                                    @if($slide['desc'])
                                       <p class="desc">{!! clean($slide['desc']) !!}</p>
                                    @endif
                                    @if($slide['btn_shop_now'])
                                        <div class="button-wrap">
                                            <a class="slider-button" href="{{ $slide['link_shop_now'] }}">
                                                <span class="button-text">{{ $slide['btn_shop_now'] }}</span>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
@endif
