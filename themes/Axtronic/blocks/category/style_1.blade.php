<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/4/2022
 * Time: 9:52 PM
 */
?>
@if(!empty($list_items))
    <div class="axtronic-category style-2">
        <div class="container">
            <h2 class="heading-title">{{ $title_name }}</h2>
            <div class="swiper-slider-icon swiper-container ">
                <div class="swiper-wrapper">
                    @foreach($list_items as $k=>$item)
                        @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                            @php
                                $translate = $item_cat->translate(app()->getLocale());
                                $page_search = $item_cat->getDetailUrl();
                                $image_cat = get_file_url($item_cat['image_id'] ?? "", 'full');
                            @endphp
                            <div class="swiper-slide">
                                <div class="item-icons">
                                    <a href="{{ $page_search }}">
                                        @if(!empty($item['image_id']))
                                            <img src="{{ get_file_url($item['image_id']?? false,'full') }}" alt="{{ $translate->name }}">
                                        @else
                                            <img src="{{$image_cat}}" alt="{{ $translate->name }}">
                                        @endif
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
