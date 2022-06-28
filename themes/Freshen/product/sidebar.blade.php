<form action="" class="bc_form_filter">
    <input name="sort" type="hidden" value="{{request()->query('sort')}}"/>
    <input name="list_style" type="hidden" value="{{request()->query('list_style')}}"/>
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
</form>
