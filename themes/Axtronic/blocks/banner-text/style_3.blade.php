<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/28/2022
 * Time: 4:37 PM
 */
?>
<div class="axtronic-banner {{ $banner_width }}">
    <div class="banner-wrap " style="background-image: url('{{ get_file_url( $bg_content ?? false,'full') }}')">
        <div class="d-flex align-items-center justify-content-between">
            <div class="item-content d-flex align-content-center align-items-start flex-column justify-content-center">
                {!! clean($content) !!}
            </div>

            <div class="item-content d-flex align-content-start align-items-start flex-column justify-content-end">
                {!! clean($content2) !!}
            </div>
        </div>
    </div>
</div>
