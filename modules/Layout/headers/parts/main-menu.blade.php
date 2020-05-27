<div class="bravo-main-menu">
    <div class="browse-category products-cats-menu  mf-closed">
        <div class="browse-category-btn">
            <i class="icon-menu"><span class="s-space">&nbsp;</span></i>
            <span class="text">{{__('Shop By Department')}}</span>
        </div>
        <div class="dropdown-category toggle-product-cats nav">
            @include('Layout::headers.parts.department')
        </div>
    </div>
    <div class="main-menu">
        <div class="nav">
            <?php generate_menu('primary')?>
        </div>
    </div>
    <div class="main-menu-right">
        <?php generate_menu('menu_right')?>
        @include('Language::frontend.switcher')
    </div>
</div>
<div class="mobile-menu hidden-lg hidden-md">
    <div class="container">
        <div class="mobile-menu-row">
            <a class="mf-toggle-menu" id="mf-toggle-menu" href="#">
                <i class="icon-menu"></i>
            </a>
            <div class="product-extra-search">
                <form class="products-search" method="get" action="http://demo2.drfuri.com/martfury3/">
                    <div class="psearch-content">
                        <div class="search-wrapper">
                            <input type="text" name="s" class="search-field" autocomplete="off" placeholder="I'm shopping for...">
                            <input type="hidden" name="post_type" value="product">
                            <div class="search-results woocommerce"></div>
                        </div>
                        <button type="submit" class="search-submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
