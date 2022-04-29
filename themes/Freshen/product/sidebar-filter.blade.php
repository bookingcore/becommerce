
<div class="sidebar_content_details style3">
    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
    <div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
        <div class="siderbar_widget_header">
            <h4 class="title mb0">{{__("FILTER BY")}}<a class="filter_closed_btn float-end" href="#"><small>{{__('x')}}</small><span class="flaticon-close"></span></a></h4>
        </div>
        <div class="sidebar_advanced_search_widget">
            @foreach(setting_item_with_lang_arr('fs_products_sidebar') as $widget)
                @if(!empty($widget['type']))
                    @switch($widget['type'])
                        @case('price')
                        @includeIf('product.sidebar.price')
                        @break
                        @case('category')
                        @includeIf('product.sidebar.category')
                        @break
                        @case('tag')
                        @include('product.sidebar.tags')
                        @break
                        @case('attr')
                        @include('product.sidebar.attributes')
                        @break
                        @case('content_text')
                        @includeIf('product.sidebar.text')
                        @break
                    @endswitch
                @endif
            @endforeach
        </div>
    </div>
</div>
