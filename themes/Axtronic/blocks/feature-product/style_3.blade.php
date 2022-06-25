<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/7/2022
 * Time: 4:59 PM
 */
?>
@php
    $bg_image = "";
$padding = 0;
    if (!empty($bg_content)){
        $bg_image = get_file_url( $bg_content ?? false,'full');
    }
    if (!empty($bg_content) || !empty($bg_color)){
        $padding = "60px 60px 30px";
    }
@endphp
@if(!empty($rows->count()))
    <div class="{{$width_style}}">
        <div class="axtronic-list-products axtronic-features axtronic-features-slider" style="background-image: url('{{ $bg_image}}'); background-color: {{ $bg_color }}; padding: {{$padding}}">
            <div class="product-box" >
                <div class="product-box-title {{ $style_header }}">
                    <h2 class="heading-title {{ $is_dark ? "dark" : 'light' }}">{!! clean($title) !!}</h2>
                </div>
                <div class="axtronic-slider-content">
                    <div class="product-slider swiper-container">
                        <div class="swiper-wrapper">
                            @if(!empty($rows))
                                @foreach($rows as $row)
                                    <div class="swiper-slide">
                                        @include('product.search.loop')
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif
