<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/18/2022
 * Time: 10:27 AM
 */
?>
@if(!empty($brands))
    <div class="axtronic-brands style-2" >
        <div class="container">
            <div class="swiper-slider-brands-2 swiper-container">
                <div class="swiper-wrapper">
                    @foreach($brands as $brand)
                        <div class="swiper-slide">
                            <div class="item-brand">
                                <a href="{{ $brand['link_brand']  }}"><img src="{{ get_file_url($brand['image']?? false,'full') }}" class="size-full" alt="{{ $brand['title']  }}" ></a>
                            </div>
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
