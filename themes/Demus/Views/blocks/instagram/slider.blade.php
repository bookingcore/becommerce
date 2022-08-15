<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/23/2022
 * Time: 12:04 AM
 */
?>
@if(!empty($list_items))
    <section class="demus-instagram">
        @if(!empty($title))
            <div class="box-heading-title text-center mb-xl-3 pb-4 ">
                <h2 class="heading-title ">{!! clean($title) !!}</h2>
                <p class="sub-heading">{!! clean($sub_title) !!}</p>
            </div>
        @endif
        <div class="instagram-slider swiper">
            <div class="swiper-wrapper">
                @foreach($list_items as $key => $item)
                    <div class="swiper-slide ">
                        <a class="gallery_item" href="{{ get_file_url($item['image_icon'] ?? '' , "full") }}">
                            @if(!empty($item['image_icon']))
                                <img class="img-fluid img-circle-rounded w100" src="{{ get_file_url($item['image_icon'] ?? '' , "full") }}" alt="Instagram">
                                <div class="gallery_overlay">
                                    <div class="icon popup-img">
                                        <span class="axtronic-icon-instagram"></span>
                                    </div>
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination light"></div>
        </div>
    </section>
@endif
