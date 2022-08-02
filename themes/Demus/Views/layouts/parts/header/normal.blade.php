<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/15/2022
 * Time: 10:14 AM
 */
?>
@include('layouts.parts.header.topbar')
<div class="container">
    <div class="header-wrap">
        <div class="site-branding">
            <div class="header__content-left">
                @if(!empty($logo_header = setting_item('demus_logo_dark')))
                    <a class="axtronic-logo text-decoration-none" href="{{url('/')}}">
                        <img src="{{ get_file_url($logo_header,'full') }}" alt="">
                    </a>
                @endif
            </div>
        </div>
        <div class="site-navigation">
            <div class="site-main-menu">
                @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
            </div>
        </div>

    </div>
</div>
<div class="header__content-bottom">
    <div class="container">
        <div class="row align-items-center justify-content-end" >

            <div class="col-md-2">
                <p> {{setting_item('axtronic_header_contact')}}</p>
            </div>
            <div class="col-md-7">
                @include('layouts.parts.header.search')
            </div>
        </div>
    </div>
</div>
