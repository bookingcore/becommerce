<div class="text-base">
    <div id="mega-menu" class="hidden">
        <div class="btn-mega home{{ $header_style ?? setting_item('freshen_header_style') }}">
            <span class="pre_line"></span>
            <span class="ctr_title">{{ __("ALL CATEGORIES") }}</span>
            <i class="fa fa-angle-down icon"></i>
        </div>
        @php generate_menu('department',['walker'=>\Themes\Freshen\Walkers\DepartmentMenuWalker::class]) @endphp
    </div>

    <button data-dropdown-toggle="mega-menu-dropdown" data-dropdown-placement="bottom-start" class="flex items-center w-full py-2 pr-4 pt-4 pb-4 font-medium text-base">
        <svg class="mr-2" width="25" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="5" y="6" width="15" height="2" fill="#041E42"/>
            <rect y="14" width="20" height="2" fill="#041E42"/>
            <rect y="22" width="15" height="2" fill="#041E42"/>
        </svg>
        {{ __("Browse Categories") }}
    </button>
    <div id="mega-menu-dropdown" class="absolute z-10 hidden min-w-[270px] text-sm bg-white border border-gray-100 rounded-b shadow-md text-base">
        @php generate_menu('department',['walker'=>\Themes\Zeomart\Walkers\DepartmentMenuWalker::class]) @endphp
    </div>
    <div class="hidden rounded-br-lg"></div>
</div>
