@php $main_color =setting_item('style_main_color','#fcb800');
$style_typo = json_decode(setting_item_with_lang('style_typo',false,"{}"),true);
@endphp
<style id="custom-css">
    body{
        @if(!empty($style_typo) && is_array($style_typo))
            @foreach($style_typo as $k=>$v)
                  {{str_replace('_','-',$k)}}:{!! $v !!};
            @endforeach
        @endif
    }

    .bravo-booking-page .form-actions .btn,
    .bravo_detail_product .col-product-info .product-detail-gallery .flex-control-nav li a.flex-active,
    .bravo_footer .bravo_footer_menu .mf-els-modal-mobile .mf-cart-mobile .widget-canvas-content .widget_shopping_cart_content .cart__footer figure a.checkout,
    .btn.btn-primary,
    .mf-els-modal-mobile .mf-cart-mobile .mobile-cart-header,
    .mf-els-modal-mobile .search-wrapper,
    .primary-mobile-nav .mobile-nav-header,
    .ps-shopping-cart .ps-btn--outline:hover,
    .ps-shopping-cart .ps-btn:not(.ps-btn--outline),
    .bravo-header .header-style-default .bravo-main-header .bravo-extra-menu li .cart__footer a,
    .bravo-header .header-style-default .bravo-main-header .bravo-extra-menu li .cart__footer a:active,
    .martfury-button.color-dark a,
    .bravo_profile_sidebar .quick_info .quick-info-wrapper input[type=submit], .bravo_profile_sidebar .quick_info .quick-info-wrapper textarea[type=submit],
    .bravo-reviews .review-box .mf-product-rating .review-form .comment-form .form-submit .btn,
    .product-detail-add-to-cart .btn.buy_now,
    .site-footer .footer-newsletter .newsletter-form .mc4wp-form-fields input[type=submit],
    .mf-banner-large .banner-price .link,
    .bravo-header .header-style-default,
    .bravo-header .products-cats-menu .menu > li:hover,
    ul.products li.product .product-inner .mf-product-thumbnail .footer-button a:hover,
    .mf-banner-medium.layout-2 .banner-content .link, .mf-banner-medium.layout-3 .banner-content .link, .mf-banner-medium.layout-4 .banner-content .link, .mf-banner-medium.layout-5 .banner-content .link,
    .slick-dots li:hover button, .slick-dots li.slick-active button
    {
        background-color: {{$main_color}};
    }


    .bravo_detail_product .col-product-info .product-tabs .nav-tabs li a:hover,
    .bravo_detail_product .col-product-info .product-tabs .nav-tabs li a.active{
        border-bottom: 3px solid {{$main_color}};
    }

    .slick-dots li button,
    .slick-dots li:hover button, .slick-dots li.slick-active button
    {
        border: 1px solid {{$main_color}};
    }

    .ps-shopping-cart .ps-btn--outline:hover,
    .martfury-bubbles,
    .mf-image-box:hover{
        border-color: {{$main_color}};
    }

    .bravo_style-normal .extra-link:hover,
    .mf-product-deals-day .header-link a:hover,
    .ps-product__content a:hover,
    .mf-navigation-mobile .navigation-icon.active,
    .ps-section--shopping .ps-section__content .ps-table--shopping-cart tbody tr .ps-product--cart .ps-product__content a:hover,
    .blog-wapper .entry-meta a:hover,
    .blog-wapper .entry-title a:hover,
    .martfury-testimonial-slides .testimonial-info > i,
    .martfury-icon-box .box-url:hover,
    .page-header-blog .breadcrumbs li.active a,
    .bravo-header .header-style-default .bravo-main-header .bravo-extra-menu li .u-right .dropdown-menu li a:hover,
    .bravo_wrap .bravo_categories .list-item .item .mf-image-box:hover a,
    .breadcrumbs > li > a:hover,
    .product-categories > li > a:hover,
    .children-menu > li > a:hover,
    .nav li li .mega-menu-submenu a:hover,
    .martfury-icon-box.icon_position-left .box-icon,
    ul.products li.product h2:hover a
    {
        color: {{$main_color}} !important;
    }

    {!! setting_item_with_lang('style_custom_css') !!}
</style>
