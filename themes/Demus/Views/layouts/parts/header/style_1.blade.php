<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/15/2022
 * Time: 10:15 AM
 */
?>
<div class="header__inner" >
    <div class="row">
        <div class="header-left col col-lg-auto">
            @if(!empty($logo_header = setting_item('demus_logo_dark')))
                <a class="axtronic-logo text-decoration-none" href="{{url('/')}}">
                    <img src="{{ get_file_url(setting_item('demus_logo_dark'),'full') }}" alt="">
                </a>
            @endif
        </div>
        <div class="header-center col-auto">
            <div class="main-menu">
                @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
            </div>
        </div>
        <div class="header-right d-flex align-items-center col-auto">
            @include('layouts.parts.header.user-action')
        </div>
    </div>
</div>
