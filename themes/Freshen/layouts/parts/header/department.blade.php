<div class="posr logo1">
    <div id="mega-menu">
        <div class="btn-mega">
            <span class="pre_line"></span>
            <span class="ctr_title">{{ __("ALL CATEGORIES") }}</span>
            <i class="fa fa-angle-down icon"></i>
        </div>
        @php generate_menu('department',['walker'=>\Themes\Freshen\Walkers\DepartmentMenuWalker::class]) @endphp
    </div>
</div>