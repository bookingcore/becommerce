<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/9/2022
 * Time: 8:45 AM
 */
?>

{{--Axtronic Category--}}

@if($categories_product)
<div class="axtronic-category">
    <div class="container">
        <h2 class="heading-title">{{ $title_name }}</h2>
        <div class="swiper-slider-icon swiper-container ">
            <div class="swiper-wrapper">
                @foreach($categories_product as $category)
                    <div class="swiper-slide">
                        <div class="item-icons">
                            <a href="{{ $category['link'] }}">
                                <i class="{{ $category['icon'] }}"></i>
                            </a>
                        </div>
                        <h3 class="item-title"><a href="{{ $category['link'] }}">{{ $category['title_category'] }}</a></h3>
                    </div>
                @endforeach
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>
</div>
@endif
