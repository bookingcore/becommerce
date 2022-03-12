@php $languages = \Modules\Language\Models\Language::getActive();
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
@endphp
<header id="masthead" class="header">
    @include('layouts.parts.header.topbar')
    <div class="container">
        <div class="header-wrap">
            <div class="site-branding">
                <div class="header__content-left">
                    <a class="bc-logo text-decoration-none" href="{{url('/')}}">
                        {{--@if($logo_id = setting_item("logo_id"))--}}
                            {{--<?php $logo = get_file_url($logo_id,'full') ?>--}}
                            {{--<img src="{{$logo}}" alt="{{setting_item("site_title")}}">--}}
                        {{--@else--}}
                            {{--<span class="logo-text fs-33 fw-700 c-000000">{{__('Be')}}<span class="hl fw-700">{{__("Commerce")}}</span></span>--}}
                        {{--@endif--}}
                        <img src="{{ theme_url('Axtronic/images/logo-white.svg') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="site-navigation">
                <div class="site-main-menu">
                  @php generate_menu('primary',['class'=>'me-auto mb-2 mb-lg-0']) @endphp
                </div>
            </div>
            <div class="site-member">
                <ul class="topbar-items nav">
                    @if(!Auth::id())
                        <li class="login-item">
                            <a href="#login" data-bs-toggle="modal" data-target="#login" class="login nav-link text-white">
                                <span class="account-user group-icon-action">
                                    <i aria-hidden="true" class="axtronic-icon- axtronic-icon-user"></i>               
                                </span>
                                <span class="account-content group-icon-content">
                                    <span class="sub-text">{{__('Login')}}</span>
                                </span>                   
                            </a>
                        </li>
                        <li class="signup-item">
                            <a href="#register" data-bs-toggle="modal" data-target="#register" class="signup  nav-link  text-white">
                                <span class="account-user group-icon-action">
                                    <i aria-hidden="true" class="axtronic-icon- axtronic-icon-user"></i>               
                                </span>
                                <span class="account-content group-icon-content">
                                    <span class="sub-text">{{__('Sign Up')}}</span>
                                </span>   
                            </a>
                        </li>
                    @else
                        @include('layouts.parts.header.notification')
                        @include('layouts.parts.header.user')
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="header__content-center">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <select name="cat_slug" class="form-select f-w-30 d-none d-lg-block me-1">
                        <option value="">{{__("All")}}</option>
                        @php
                            $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                                foreach ($categories as $category) {
                                    $translate = $category->translate(app()->getLocale());
                                    $has_children = count($category->children);
                                    $selected = '';
                                    if((isset($current_cat) and $category->id == $current_cat->id)){
                                        $selected = 'selected';
                                    }
                                    echo '<option '.$selected.' value='.$category->slug.'>'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</option>'.PHP_EOL;
                                    if($has_children){
                                        $traverse($category->children, $prefix,$level + 1);
                                    }
                                }
                            };
                            $traverse($categories,'&#8211;');
                        @endphp
                    </select>
                </div>
                <div class="col-sm-3">
                    Find all you need here!
                </div>
                <div class="col-sm-6">
                    @include('layouts.parts.header.search')
                </div>
            </div>
        </div>
    </div>
</header>
