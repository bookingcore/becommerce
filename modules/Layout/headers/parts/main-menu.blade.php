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
    @include('Layout::headers.parts.searchbox')
</div>
