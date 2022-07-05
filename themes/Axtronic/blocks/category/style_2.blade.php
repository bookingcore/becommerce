<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/4/2022
 * Time: 9:52 PM
 */
?>
@if($list_items)
    <div class="axtronic-category">
        <div class="container">
            <h2 class="heading-title">{{ $title_name }}</h2>
            <div class="swiper-slider-icon swiper-container ">
                <div class="swiper-wrapper">
                    @foreach($list_items_2 as $k=>$item)
                        @php $image_url = get_file_url($item['image_id'] ?? "", 'full'); @endphp
                        @foreach($item['categories'] as $cate)
                        @php
                            $translate = $cate->translate(app()->getLocale());
                            $page_search = $cate->getDetailUrl();
                        @endphp
                        <div class="swiper-slide">
                            <a href="{{ $page_search }}">
                            <div class="item-icons">
                                @if($item['icon'])
                                    <i class="{{ $item['icon'] }}"></i>
                                @else
                                    <img src="{{$image_url}}" alt="{{ $translate->name }}">
                                @endif
                            </div>
                            <div class="item-title">
                                <h3 class="item-title">{{ $translate->name }}</h3>
                            </div>
                            </a>
                        </div>
                        @endforeach
                    @endforeach
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
    </div>
@endif
