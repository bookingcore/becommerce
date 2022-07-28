<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/21/2022
 * Time: 12:06 AM
 */
?>
@if(!empty($list_items))
    <div class="demus-site-features " style="background-color: {{ (!empty($bg_color)) ? $bg_color : '#fff' }}">
        <div class="container">
            <div class="row">
                @foreach($list_items as $item)
                    <div class="col-xl-3 col-lg-6 col-sm-6 ">
                        <div class="d-flex align-items-center justify-content-center flex-column item-features {{ !empty($item['is_dark']) ? 'dark' : 'light' }}">
                            <div class="item-icon">
                                <img src="{{get_file_url( $item['image_icon'] ?? false,'full')}}" alt="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="item-content text-center">
                                <h5 class="mb-0">{{ $item['title'] ?? '' }}</h5>
                                <p class="sub-heading">{{$item['sub_title'] ?? ''}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
