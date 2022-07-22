<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/23/2022
 * Time: 1:25 AM
 */
?>
<div class="axtronic-news">
    <div class="container">
        <h2 class="heading-title mb-4 {{ $style_title }}">{{ $title }}</h2>
        <div class="swiper-slider-news swiper-container">
            <div class="swiper-wrapper">
                @foreach($rows as $k=>$row)
                    <div class="swiper-slide">
                        @include('news.loop')
                    </div>
                @endforeach
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
