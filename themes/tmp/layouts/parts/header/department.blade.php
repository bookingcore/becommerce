<div class="menu--product-categories">
    <div class="menu__toggle">
        <i class="icon-menu"></i>
        <span>{{ __("Shop by Department") }}</span>
    </div>
    <div class="menu__content">
        <?php generate_menu('department',[
            'walker'=>\Modules\Product\Walkers\DepartmentMenuWalker::class
        ]) ?>
    </div>
</div>