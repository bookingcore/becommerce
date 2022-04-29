<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/20/2022
 * Time: 3:43 PM
 */
?>

<!-- Slider main container -->

<div class="axtronic-banner-slider mt-4 mb-5">
    <div class=" {{!empty($width_slider) ? $width_slider : ""}} ">
        <div class="row">
            @if($is_category)
                <div class="col-sm-3">
                    @include('layouts.parts.header.category')
                </div>
            @endif
            <div class="col-sm-6">
                @if(!empty($sliders_banner))
                    <div class="banner-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper axtronic-modern-slider ">
                            <!-- Slides -->
                            @foreach($sliders_banner as $slide)
                                <div class="swiper-slide">
                                    <div class="axtronic-box">
                                        <div class="axtronic-box-inner">
                                            <div class="slide-bg-wrap axtronic-image">
                                                <div class="slide-bg image" style="background-image: url('{{ get_file_url($slide['image']?? false,'full') }}')"></div>
                                            </div>
                                            <div class="slide-content">
                                                <div class="slide-layers">
                                                    <div class="title-wrap-line">
                                                        @if($slide['sub_title'])
                                                            <div class="sub-title-wrap">
                                                                <h4 class="sub-title">{{ $slide['sub_title'] }}</h4>
                                                            </div>
                                                        @endif
                                                        @if($slide['title'])
                                                        <div class="title-wrap">
                                                            <h3 class="title">{!! clean($slide['title']) !!}</h3>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    @if($slide['sub_text'])
                                                    <div class="description-wrap">
                                                        <div class="description">
                                                            <p>{!! clean($slide['sub_text']) !!}</p>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($slide['btn_shop_now'])
                                                        <div class="button-wrap">
                                                            <a class="elementor-button" href="{{ $slide['link_shop_now'] }}">
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
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                @endif
            </div>
            <div class=" {{$is_category ? "col-sm-3" : "col-sm-6"}}">
                @if(!empty($sliders_2))
                    @php
                        switch (count($sliders_2)){
                            case '1': $classItem = "item_style_1"; break;
                            case '2': $classItem = "item_style_2"; break;
                            case '3': $classItem = "item_style_3"; break;
                            case '4': $classItem = "item_style_4"; break;
                            default: $classItem = "item_style_1";
                        }
                    @endphp
                    <div class="axtronic-promotions {{$classItem}}">
                        @foreach($sliders_2 as $key => $item)
                            @php
                                switch ($item['position']){
                                    case 'top_right': $classPosition = "align-items-end justify-content-start"; break;
                                    case 'bottom_left': $classPosition = "align-items-start justify-content-end"; break;
                                    case 'bottom_right': $classPosition = "align-items-end justify-content-end"; break;
                                    case 'center_right': $classPosition = "align-items-end justify-content-center"; break;
                                    case 'center_left': $classPosition = "align-items-start justify-content-center"; break;
                                    default: $classPosition = "align-items-start justify-content-start";
                                }
                            @endphp
                            <div class="promotions-item {{$classItem}} {{ $item['style_color']}}">
                                <div class="item-bg" style="background-image: url({{ get_file_url($item['image'] ?? '' , "full") }});"></div>
                                <div class="item-content d-flex flex-column {{ $classPosition }}">
                                    <span class="sub-title">{{ $item['sub_title'] ?? '' }}</span>
                                    <h3>{{ $item['title'] ?? '' }}</h3>
                                    <p>
                                        {!! $item['content'] ?? '' !!}
                                    </p>
                                    <a href="{{ $item['link'] ?? '' }}" class="item-button">{{ __('Shop Now') }} <i class="axtronic-icon-angle-right"></i> </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>


