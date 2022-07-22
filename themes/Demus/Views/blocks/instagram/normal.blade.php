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
        <div class="instagram-gallery">
            <div class="container-fluid">
                <div class="row g-0 row-cols-2 row-cols-ms-3 row-cols-md-3 row-cols-lg-6">
                    @foreach($list_items as $key => $item)
                        <div class="col ">
                            <a  class="gallery_item" href="{{ get_file_url($item['image_icon'] ?? '' , "full") }}">
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
            </div>
        </div>
    </section>
@endif
