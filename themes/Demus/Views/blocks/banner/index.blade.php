<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 7/20/2022
 * Time: 3:37 PM
 */
?>
<div class="{{(!empty($style) ? $style : "") }}">
    <div class="demus-banner" style="background-image: url('{{ get_file_url( $image ?? false,'full') }}')">
        <div class="container">
            <div class="row {{$position}}">
                <div class="col-12 col-md-6">
                    <div class="item-content d-flex flex-column justify-content-center {{ !empty($is_dark) ? 'dark' : 'light' }}">
                        @if(!empty($sub_title))
                            <p class="sub-heading">{!! clean($sub_title) !!}</p>
                        @endif
                        @if(!empty($title))
                            <h1>{!! clean($title) !!}</h1>
                        @endif
                        @if(!empty($content))
                            <p class="sub-heading">{!! clean($content) !!}</p>
                        @endif
                        @if(!empty($text_url))
                            <a href="{{ $url }}" class="btn-link-outline ">{{ $text_url }} </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

