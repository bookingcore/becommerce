<?php
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
?>
<form class="bc-form-quick-search d-flex align-items-center justify-content-center" action="{{route('product.index')}}" method="get">
    <div class="menu-bar d-lg-none d-block fs-24 px-3" data-bs-toggle="collapse" data-bs-target="#bc-main-menu" aria-controls="bc-main-menu" aria-expanded="false">
        <i class="axtronic-icon-bars"></i>
    </div>
    <div class="form-group d-flex w-100">
        <select name="cat_slug" class="form-select f-w-30 d-none d-lg-block me-1">
            <option value="">{{__("All")}}</option>
            @php
                $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                    foreach ($categories as $category) {
                        $translate = $category->translate(app()->getLocale());
                        $has_children = count($category->children);
                        $selected = '';
                        if((isset($current_cat) and $category->id == $current_cat->id)){
                            $selected = 'selected';
                        }
                        echo '<option '.$selected.' value='.$category->slug.'>'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</option>'.PHP_EOL;
                        if($has_children){
                            $traverse($category->children, $prefix,$level + 1);
                        }
                    }
                };
                $traverse($categories,'&#8211;');
            @endphp
        </select>
        <input name="s" class="form-control me-1" type="text" placeholder="{{ __("I'm shopping for...") }}">
        <button type="submit" class="btn bg-main c-white">{{ __("Search") }}</button>
    </div>
</form>
