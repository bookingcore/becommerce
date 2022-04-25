<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/25/2022
 * Time: 4:16 PM
 */
?>

<div class="axtronic-banner {{!empty($banner_width) ? $banner_width : ""}}">
    <div class="banner-wrap " style="background-image: url('{{ get_file_url( $bg_content ?? false,'full') }}')">
        <div class="d-flex align-items-center justify-content-center">
            <div class="item-content d-flex align-content-center align-items-center flex-column justify-content-center">
                {!! clean($content) !!}
            </div>
        </div>
    </div>
</div>
