<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/25/2022
 * Time: 4:18 PM
 */
?>
<div class="axtronic-news">
    <div class="container">
        <h2 class="heading-title ">{{ $title }}</h2>
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
