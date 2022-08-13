<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/5/2022
 * Time: 3:55 PM
 */
?>

<div class="site-user-side side-wrap">
    <a href="#" class="close-user-side close-side"><span class="screen-reader-text">{{__('Close')}}</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">{{ __('SIGN IN') }}</span>
    </div>
    <div class="side-account-form-wrap">
        <div class="box-content">
            <div class="form-login active">
                <img class="img-label" src="{{ theme_url('Demus/images/login.svg') }}" alt="Login">
                @include('auth/login-form')
            </div>
            <div class="form-register">
                <img class="img-label" src="{{ theme_url('Demus/images/register.svg')}}" alt="Register">
                @include('auth/register-form')
                <a class="login-link" href="#">{{__('Already has an account')}}</a>
            </div>
            <div class="form-lost-password">
                <img class="img-label" src="{{ theme_url('Demus/images/register.svg')}}" alt="Lost Password">
                <div class="woocommerce-notices-wrapper"></div>

                <p class="note">Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.</p>
                @include('auth/passwords/form-forgot')
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
        <div class="menu-side-heading side-heading mobile-nav-tabs">
            <ul>
                <li class="mobile-tab-title mobile-pages-title active" data-menu="pages">
                    <span>{{__('Main Menu')}}</span>
                </li>
                <li class="mobile-tab-title mobile-categories-title" data-menu="categories">
                    <span>{{__('Shop by Categories')}}</span>
                </li>
            </ul>
        </div>
        <div class="mobile-pages-menu mobile-menu-tab active">
            @php generate_menu('primary',['class'=>'menu-mobile-page']) @endphp
        </div>
        <div class="mobile-categories-menu mobile-menu-tab">
            <ul class="navbar-nav menu-mobile-categories">
                @php
                    $traverse = function ($categories, $prefix = '') use (&$traverse) {
                        foreach ($categories as $category) {
                            $translate = $category->translate(app()->getLocale());
                            $has_children = count($category->children);
                            if(empty($prefix)){
                                echo '<li class="nav-item '.($has_children ? 'menu-item-has-children' : '').'" >';
                                echo '<a class="nav-link " href="'.$category->getDetailUrl().'" data-bs-toggle="collapse" data-bs-target="#cat-'.$category->id.'" aria-expanded="true">'.e($translate->name).'</a>';
                            }else{
                                echo '<li class="nav-item ">';
                                echo '<a class="nav-link " href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                            }
                            if($has_children){
                                echo '<ul class="dropdown-menu collapse w-100 sub-cat" id="cat-'.$category->id.'">';
                                    $traverse($category->children, 1);
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    };
                    $traverse($categories);
                @endphp
            </ul>
        </div>
    </div>


</div>
<div class="menu-side-overlay side-overlay"></div>

@include('layouts.parts.header.notification')
<div class="footer-width-fixer">

</div>
