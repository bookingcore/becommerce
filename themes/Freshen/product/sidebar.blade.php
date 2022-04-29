<div class="sidebar_listing_grid1 mb30  dn-lg">
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
