<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/23/2022
 * Time: 11:26 PM
 */
?>
<div class="{{!empty($banner_width) ? $banner_width : ""}}">
    <div class="axtronic-banner style-2">
        <div class="banner-wrap " style="background-image: url('{{ get_file_url( $bg_content ?? false,'full') }}')">
            <div class="d-flex align-items-center justify-content-between">
                <div class="item-content d-flex align-content-center align-items-start flex-column justify-content-center">
                    {!! clean($content) !!}
                </div>
                @if(!empty($image))
                    <div class="item-image">
                        <img src="{{ get_file_url($image ?? '' , "full") }}" alt="">
                    </div>
                @endif
                <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-end">
                    {!! clean($content2) !!}
                </div>
            </div>
        </div>
    </div>
</div>
