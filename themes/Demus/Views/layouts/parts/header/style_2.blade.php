<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/15/2022
 * Time: 10:15 AM
 */
?>
<div class="header__inner">
    <div class="row align-items-center justify-content-between">
        <div class="header-left col col-lg-auto">
            <div class="vertical-navigation">
                <div class="vertical-navigation-header">
                    <i aria-hidden="true" class="axtronic-icon-bars"></i>
                </div>
                <nav class="vertical-menu">
                    @php generate_menu('department',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
                </nav>
            </div>
        </div>
        <div class="header-center col">
            @if(!empty($logo_header = setting_item('demus_logo_dark')))
                <a class="axtronic-logo text-decoration-none" href="{{url('/')}}">
                    <img src="{{ get_file_url(setting_item('demus_logo_dark'),'full') }}" alt="">
                </a>
            @endif
        </div>
        <div class="header-right d-flex align-items-center col-auto justify-content-end">
            @include('layouts.parts.header.user-action')
        </div>
    </div>
</div>

<div class="main-menu">
    @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
</div>
