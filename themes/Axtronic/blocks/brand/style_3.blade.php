<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/25/2022
 * Time: 4:19 PM
 */
?>

@if(!empty($brands))
<div class="axtronic-brands style-3"  style="background-color: {{ $bg_color }}">
    <div class="container">
        <div class="swiper-slider-brands swiper-container">
            <div class="swiper-wrapper">
                @foreach($brands as $brand)
                    <div class="swiper-slide">
                        <div class="item-brand">
                            <a href="{{ $brand['link_brand']  }}"><img src="{{ get_file_url($brand['image']?? false,'full') }}" class="size-full" alt="{{ $brand['title']  }}" ></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
