<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/15/2022
 * Time: 10:15 AM
 */
?>
@include('layouts.parts.header.topbar')
<div class="container">
    <div class="header-wrap">
        <div class="site-branding">
            <div class="header__content-left">
                @if(!empty($logo_header = setting_item('axtronic_logo_dark')))
                    <a class="axtronic-logo text-decoration-none" href="{{url('/')}}">
                        <img src="{{ get_file_url($logo_header,'full') }}" alt="">
                    </a>
                @endif
            </div>
        </div>
        <div class="site-navigation">
            @include('layouts.parts.header.search')
        </div>

    </div>
</div>
<div class="header__content-bottom">
    <div class="container">
        <div class="row align-items-center justify-content-end" >

            <div class="col-md-7">
                <div class="site-main-menu">
                    @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
                </div>
            </div>
            <div class="col-md-2">
                <div class="icon-box-header">
                    <div class="icon-box-icon">
                       <span> <i aria-hidden="true" class="axtronic-icon- axtronic-icon-call-calling"></i></span>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="icon-box-title">
                            {{ setting_item('axtronic_hotline_text') }}
                        </h3>
                        <p class="icon-box-description">
                            {{ setting_item('axtronic_hotline_contact') }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
