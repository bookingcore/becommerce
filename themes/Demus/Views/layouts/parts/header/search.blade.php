<?php
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
?>
@if(get_search_engine())
    <div id="bc_autocomplete" data-placeholder="{{__("I'm shopping for...")}}"></div>
@else
    <div class="search-form">
        <form class="demus-form-quick-search d-flex align-items-center justify-content-center" action="{{route('product.index')}}" method="get">
            <div class="form-group d-flex w-100">
                <input name="s" class="form-control" type="text" value="{{ request()->input("s") }}" placeholder="{{ __("Search products...") }}">
                <button type="submit" class="button-hover"><i class="axtronic-icon-search"></i></button>
            </div>
        </form>
    </div>

@endif
