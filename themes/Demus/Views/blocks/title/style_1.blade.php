<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/22/2022
 * Time: 4:43 PM
 */
?>

<section class="demus-title">
    <div class="container">
        @if(!empty($title))
            <div class="box-heading-title text-center mb-xl-3 pb-4 {{ !empty($is_dark) ? 'dark' : 'light' }}">
                <h2 class="heading-title ">{!! clean($title) !!}</h2>
                <p class="sub-heading">{!! clean($sub_title) !!}</p>
            </div>
        @endif
        <figure >
            <img src="{{ get_file_url( $image ?? false,'full') }}" alt="{{$title_content}}">
            @if(!empty($title_content))
                <figcaption>
                    <h2>{!! clean($title_content) !!}</h2>
                    <p>{!! clean($sub_title_content) !!}</p>
                </figcaption>
            @endif
        </figure>
    </div>
</section>
