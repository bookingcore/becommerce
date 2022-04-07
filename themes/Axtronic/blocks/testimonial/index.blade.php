<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/25/2022
 * Time: 4:18 PM
 */
?>

@if($list_testimonial)
    <div class="axtronic-testimonial">
        <div class="container">
            <h2 class="heading-title text-center">{{ $title  }}</h2>
            <div class="swiper-slider-testimonial swiper-container">
                <div class="swiper-wrapper">
                    @foreach($list_testimonial as $item)
                    <div class="swiper-slide">
                        <div class="inner">
                            <div class="testimonial-image">
                                <img src="{{ get_file_url($item['image']?? false,'full') }}" class="attachment-full size-full" alt="{{ $item['title_item'] }}" >
                            </div>
                            <div class="caption">
                                <div class="details">
                                    <h2 class="name">{{ $item['title_item']  }}</h2>
                                    <h3 class="job">{{ $item['job'] }}</h3>
                                </div>
                                <div class="stars">
                                    @for($i = 1; $i <= $item['number_star']; $i++)
                                        <i class="axtronic-icon-star-sharp"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="testimonial-content"> {{ $item['content']  }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
@endif
