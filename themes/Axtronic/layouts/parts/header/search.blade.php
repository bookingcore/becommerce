<?php
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
?>
<form class="axtronic-form-quick-search d-flex align-items-center justify-content-center" action="{{route('product.index')}}" method="get">
    <div class="form-group d-flex w-100">
        <div class="product-cat">
            <div class="product-cat-label">
                <div class="box">
                    <span class="product-cat-name" id="product-cat-name">{{__('All Category')}} </span>
                    <i class="axtronic-icon-angle-down"></i>
                    <select name="cat_slug" class="form-select f-w-30 d-none d-lg-block me-1" id="cat_slug" onchange="getName(this)">
                        <option value="" >{{__("All Category")}}</option>
                        @php
                            $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                                foreach ($categories as $category) {
                                    $translate = $category->translate(app()->getLocale());
                                    $has_children = count($category->children);
                                    $selected = '';
                                    if((isset($current_cat) and $category->id == $current_cat->id)){
                                        $selected = 'selected';
                                    }
                                    echo '<option '.$selected.' value='.$category->slug.' data-name=" '.$translate->name.' ">'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</option>'.PHP_EOL;
                                    if($has_children){
                                        $traverse($category->children, $prefix,$level + 1);
                                    }
                                }
                            };
                            $traverse($categories,'&#8211;');
                        @endphp
                    </select>
                </div>
            </div>
        </div>
        <input name="s" class="form-control" type="text" placeholder="{{ __("Search products...") }}">
        <button type="submit" class="btn"><i class="axtronic-icon-search"></i><span>{{ __("Search") }}</span></button>
    </div>
</form>
<script>

</script>
