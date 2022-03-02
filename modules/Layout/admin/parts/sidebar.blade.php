<?php
$menus = \Modules\Core\Helpers\AdminMenuManager::menus();
?>
<ul class="main-menu pb-5">
    @foreach($menus as $id=>$menuItem)
        <?php
        if(!empty($menuItem['permission']) and !auth()->user()->hasPermission($menuItem['permission'])) continue;
        ?>
        <li data-pos="{{$menuItem['position']}}" class="@if(\Modules\Core\Helpers\AdminMenuManager::isActive($id,$menuItem)) active @endif @if(!empty($menuItem['children'])) has-children @endif"><a href="{{ url($menuItem['url']) }}">
                @if(!empty($menuItem['icon']))
                    <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                @endif
                {!! clean($menuItem['title'],[
                    'Attr.AllowedClasses'=>null
                ]) !!}
            </a>
            @if(!empty($menuItem['children']))
                <span class="btn-toggle"><i class="fa fa-angle-left pull-right"></i></span>
                <ul class="children">
                    @foreach($menuItem['children'] as $menuItem2)
                        <li class="@if(\Modules\Core\Helpers\AdminMenuManager::isActive($id,$menuItem)) active @endif"><a href="{{ url($menuItem2['url']) }}">
                                @if(!empty($menuItem2['icon']))
                                    <i class="{{$menuItem2['icon']}}"></i>
                                @endif
                                {!! clean($menuItem2['title'],[
                                    'Attr.AllowedClasses'=>null
                                ]) !!}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>
