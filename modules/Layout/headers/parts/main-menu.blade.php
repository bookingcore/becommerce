<div class="bravo-main-menu">
    <div class="browse-category">
        <div class="browse-category-btn">
            <i class="icon-menu"><span class="s-space">&nbsp;</span></i>
            <span class="text">{{__('Shop By Department')}}</span>
        </div>
        <div class="dropdown-category">
            @include('Layout::headers.parts.department')
        </div>
    </div>
    <div class="main-menu">
        <?php generate_menu('primary')?>
    </div>
    <div class="main-menu-right">
        <?php generate_menu('menu_right')?>
        @include('Language::frontend.switcher')
    </div>
</div>
