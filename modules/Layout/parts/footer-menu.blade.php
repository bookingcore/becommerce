<div class="bravo_footer_menu">
    <div class="mf-els-modal-mobile" id="mf-els-modal-mobile">
        <div class="mf-search-mobile-modal mf-els-item" id="mf-search-mobile">
            <form class="products-search" method="get" action="{{route('product.index')}}">
                <div class="search-wrapper">
                    <input type="text" name="s" class="search-field" autocomplete="off" placeholder="I'm shopping for...">
                    <input type="hidden" name="post_type" value="product">
                    <button type="submit" class="search-submit"><i class="icon-magnifier"></i></button>
                </div>
                <div class="search-results"></div>
            </form>
        </div>
        <div class="primary-mobile-nav mf-els-item current" id="mf-category-mobile-nav">
            <div class="mobile-nav-content">
                <div class="mobile-nav-overlay"></div>
                <div class="mobile-nav-header">
                    <h2>Shop By Departments</h2>
                    <a class="close-mobile-nav"><i class="icon-cross"></i></a>
                </div>
                @include('Layout::headers.parts.department')
            </div>
        </div>
        <div id="mf-cart-mobile" class="mf-cart-mobile mf-els-item mini-cart">
            <div class="mobile-cart-header">
                <h2>Shopping Cart</h2>        <a class="close-cart-mobile"><i class="icon-cross"></i></a>
            </div>

            <div class="widget-canvas-content">
                <div class="widget_shopping_cart_content">
                    @if(Cart::content())
                        @include('Booking::frontend.cart.mini-cart')
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mf-navigation-mobile" id="mf-navigation-mobile">
        <div class="navigation-list">
            <a href="{{url('/')}}" class="navigation-icon navigation-mobile_home active">
                <i class="icon-home"></i> {{__('Home')}}
            </a>
            <a href="#" class="navigation-icon navigation-mobile_cat" data-id="mf-category-mobile-nav">
                <i class="icon-menu"></i> {{__('Category')}}
            </a>
            <a href="#" class="navigation-icon navigation-mobile_search" data-id="mf-search-mobile">
                <i class="icon-magnifier"></i> {{__('Search')}}
            </a>
            <a href="#" class="navigation-icon navigation-mobile_cart" data-id="mf-cart-mobile">
                <i class="icon-bag2"></i> {{__('Cart')}}
            </a>
        </div>
    </div>
</div>
