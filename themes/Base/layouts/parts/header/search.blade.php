<?php
$categories = \Modules\Product\Models\ProductCategory::getAll();
?>
<form class="ps-form--quick-search" action="{{route('product.index')}}" method="get">
    <div class="form-group--icon"><i class="icon-chevron-down"></i>
        <select name="cat_slug" class="form-control">
            <option value="">{{__("All")}}</option>
            @php
                $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse) {
                    foreach ($categories as $category) {
                        $translate = $category->translate(app()->getLocale());
                        $has_children = count($category->children);
                        $selected = '';
                        if((isset($current_cat) and $category->id == $current_cat->id)){
                            $selected = 'selected="selected"';
                        }
                        echo '<option '.$selected.' value='.$category->slug.'>'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</option>';
                        if($has_children){
                            $traverse($category->children, $prefix,$level + 1);
                        }
                        echo '</li>';
                    }
                };
                $traverse($categories,'&#8211;');
            @endphp
        </select>
    </div>
    <input class="form-control" type="text" placeholder="I'm shopping for...">
    <button>Search</button>
</form>
