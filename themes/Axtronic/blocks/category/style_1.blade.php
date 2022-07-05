<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 5/4/2022
 * Time: 9:52 PM
 */
?>
@if(!empty($list_items))
    <div class="axtronic-category style-1">
        <div class="container">
            <h2 class="heading-title">{{ $title_name }}</h2>
            <div class="swiper-slider-icon swiper-slider-icon-1 swiper-container ">
                <div class="swiper-wrapper">
                    @foreach($list_items as $k=>$item)
                        @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                            @php
                                $translate = $item_cat->translate(app()->getLocale());
                                $page_search = $item_cat->getDetailUrl();
                                $image_cat = get_file_url($item_cat['image_id'] ?? "", 'full');
                            @endphp
                            <div class="swiper-slide">
                                <a href="{{ $page_search }}">
                                    <div class="item-icons">
                                        @if(!empty($item['image_id']))
                                            <img src="{{ get_file_url($item['image_id']?? false,'full') }}" alt="{{ $translate->name }}">
                                        @else
                                            <img src="{{$image_cat}}" alt="{{ $translate->name }}">
                                        @endif
                                    </div>
                                    <div class="item-title">
                                        <h3>{{ $translate->name }}</h3>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>
@endif
