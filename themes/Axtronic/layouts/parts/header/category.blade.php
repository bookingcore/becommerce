<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 3/14/2022
 * Time: 8:49 AM
 */
$categories = \Modules\Product\Models\ProductCategory::getAll();
if(!isset($current_cat)) $current_cat = null;
?>
<nav class="vertical-navigation" aria-label="Vertical Navigation">
    <div class="vertical-navigation-header">
        <i class="axtronic-icon-bars"></i>
        <span class="vertical-navigation-title">Shop by Categories</span>
    </div>
    <div class="vertical-menu">
        <ul class="nav menu">
            @php
                $traverse = function ($categories, $prefix = '') use (&$traverse) {
                foreach ($categories as $category) {
                    $translate = $category->translate(app()->getLocale());
                    $has_children = count($category->children);
                    if(empty($prefix)){
                        echo '<li class="nav-item has-mega-menu'.($has_children ? 'menu-item-has-children' : '').'">';
                        echo '<a class="nav-link" href="'.$category->getDetailUrl().'">'.e($translate->name).'</a>';
                    }
                    else{
                        echo '<li class="list-item">';
                        echo '<a href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                    }

                    if($has_children){
                        echo '<ul class="nav sub-menu mega-menu" id="cat-'.$category->id.'"><li class="mega-menu-item"><ul class="nav list-items">';
                            $traverse($category->children, 1);
                        echo '</ul></li></ul>';
                    }
                    echo '</li>';
                }
            };
            $traverse($categories);
            @endphp
        </ul>
    </div>
</nav>
