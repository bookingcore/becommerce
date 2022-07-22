<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/22/2022
 * Time: 4:43 PM
 */
?>

<section class="demus-title style_2" style="background-image: url('{{ get_file_url( $image ?? false,'full') }}'); background-color: {{ (!empty($bg_color)) ? $bg_color : '#fff' }}">
    <div class="container">
        @if(!empty($title))
            <div class="box-heading-title text-center {{$is_dark}}  {{ !empty($is_dark) ? 'dark' : 'light' }}">
                <h2 class="heading-title ">{!! clean($title) !!}</h2>
                <p class="sub-heading">{!! clean($sub_title) !!}</p>
                @if(!empty($text_url))
                    <a href="{{ $url }}" class="btn-link-outline ">{{ $text_url }} </a>
                @endif
            </div>
        @endif
    </div>
</section>
