

<div class="site-user-side side-wrap">
    <a href="#" class="close-user-side close-side"><span class="screen-reader-text">{{__('Close')}}</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">{{ __('SIGN IN') }}</span>
    </div>
    <div class="side-account-form-wrap">
        <div class="box-content">
            <div class="form-login active">
                <img class="img-label" src="{{ theme_url('Axtronic/images/login.svg') }}" alt="Login">
                @include('auth/login-form')
            </div>
            <div class="form-register">
                <img class="img-label" src="{{ theme_url('Axtronic/images/register.svg')}}" alt="Register">
                @include('auth/register-form')
                <a class="login-link" href="#">{{__('Already has an account')}}</a>
            </div>
            <div class="form-lost-password">
                <img class="img-label" src="{{ theme_url('Axtronic/images/register.svg')}}" alt="Lost Password">
                <div class="woocommerce-notices-wrapper"></div>
                @include('auth/passwords/reset')
                <a class="login-link" href="#">{{__('Already has an account')}}</a>
            </div>
        </div>
    </div>
</div>
<div class="user-side-overlay side-overlay"></div>
@include('order.cart.mini-cart')
@include('user.wishlist.sidebar')

<?php
    $categories = \Modules\Product\Models\ProductCategory::getAll();
    if(!isset($current_cat)) $current_cat = null;
?>
<div class="site-menu-side side-wrap">
    <div class="axtronic-mobile-nav">
        <a href="#" class="close-menu-side"><i class="axtronic-icon-times"></i></a>

        <div class="mobile-pages-menu mobile-menu-tab active">
            @php generate_menu('primary',['class'=>'menu-mobile-page']) @endphp
        </div>
    </div>


</div>
<div class="menu-side-overlay side-overlay"></div>

<div class="footer-width-fixer">

</div>
