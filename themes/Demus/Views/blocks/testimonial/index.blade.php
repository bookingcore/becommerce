<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/28/2022
 * Time: 9:14 AM
 */
?>
<section class="demus-testimonial">
    <div class="container">
        <div class="swiper-wrapper  ">
            @foreach($list_testimonial as $slide)
                <div class="swiper-slide">
                    <div class="testimonial__avatar mb-4">
                        <div class="avata d-inline-block">

                        </div>
                    </div>
                    <div class="testimonial__item-content">

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
