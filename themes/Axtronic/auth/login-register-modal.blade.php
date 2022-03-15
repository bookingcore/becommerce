<div class="site-cart-side side-wrap">
    <a href="#" class="close-cart-side close-side"><span class="screen-reader-text">Close</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">Shopping cart</span>
    </div>
</div>
<div class="cart-side-overlay side-overlay"></div>

<div class="site-user-side side-wrap">
    <a href="#" class="close-user-side close-side"><span class="screen-reader-text">Close</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">SIGN IN</span>
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
                <a class="login-link" href="#">Already has an account</a>
            </div>
            <div class="form-lost-password">
                <img class="img-label" src="{{ theme_url('Axtronic/images/register.svg')}}" alt="Lost Password">
                <div class="woocommerce-notices-wrapper"></div>
                @include('auth/passwords/reset')
                <a class="login-link" href="#">Already has an account</a>
            </div>
        </div>
    </div>

</div>
<div class="user-side-overlay side-overlay"></div>


<div class="site-wishlist-side side-wrap">
    <a href="#" class="close-wishlist-side close-side"><span class="screen-reader-text">Close</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">WISHLIST</span>
    </div>
</div>
<div class="wishlist-side-overlay side-overlay"></div>
