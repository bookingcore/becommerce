<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/13/2022
 * Time: 5:17 PM
 */
?>
<aside class="widget">
    <h6 class="widget_title">{{ $widget['title'] }}</h6>
    <ul class="list-unstyled ps-0 mt-3" id="list-cat">
        <li class="cat-item "><a href="/product">{{__("All")}}</a></li>
        @php
            $traverse = function ($categories, $prefix = '') use (&$traverse) {
                foreach ($categories as $category) {
                    $translate = $category->translate(app()->getLocale());
                    $has_children = count($category->children);
                    if(empty($prefix)){
                        if(!empty($has_children)){
                            echo '<li class="cat-item menu-item-has-children">';
                            echo '<a data-bs-toggle="collapse" data-bs-target="#cat-'.$category->id.'" aria-expanded="true" href="'.$category->getDetailUrl().'">'.e($translate->name).'</a>';
                        }
                        else{
                            echo '<li class="cat-item " data-slug="'.$category->slug.'">';
                            echo '<a href="'.$category->getDetailUrl().'">'.e($translate->name).'</a>';
                        }
                    }else{
                        echo '<li class="cat-item " data-slug="'.$category->slug.'">';
                        echo '<a href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                    }

                    if($has_children){
                        echo '<ul class="collapse w-100 sub-cat m-0" id="cat-'.$category->id.'">';
                            $traverse($category->children, 1);
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            };
            $traverse($categories);
        @endphp
    </ul>
</aside>
