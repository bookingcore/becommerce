<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/9/2022
 * Time: 8:45 AM
 */
?>

{{--Axtronic Category--}}

@if($list_items)
<div class="axtronic-category">
    <div class="container">
        <h2 class="heading-title">{{ $title_name }}</h2>
        <div class="swiper-slider-icon swiper-container ">
            <div class="swiper-wrapper">
                @foreach($list_items as $k=>$item)
                    @php $image_url = get_file_url($item['image_id'] ?? "", 'full'); @endphp
                    @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                        @php
                            $translate = $item_cat->translate(app()->getLocale());
                            $page_search = $item_cat->getDetailUrl();
                        @endphp
                        <div class="swiper-slide">
                            <div class="item-icons">
                                <a href="{{ $page_search }}">
                                    <img src="{{$image_url}}" alt="{{ $translate->name }}">
                                </a>
                            </div>
                            <h3 class="item-title"><a href="{{ $page_search }}">{{ $translate->name }}</a></h3>
                        </div>
                    @endif
                @endforeach
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>
</div>
@endif
