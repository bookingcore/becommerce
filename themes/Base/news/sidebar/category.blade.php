<?php
$categories = \Modules\News\Models\NewsCategory::search()->with(['translation'])->get()->toTree();
if(!$categories) return;
if(!isset($current_cat)) $current_cat = null;
?>
<aside class="widget widget--blog widget--categories">
    <h3 class="widget__title">{{__('Categories')}}</h3>
    <div class="widget__content">
        <ul>
            @php
                $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                    foreach ($categories as $category) {
                        $translate = $category->translate(app()->getLocale());
                        $has_children = count($category->children);
                        $selected = '';
                        if((isset($current_cat) and $category->id == $current_cat->id)){
                            $selected = 'active';
                        }
                        printf('<li class="%s"><a href="%s" >'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</a></li>',$selected,$category->getDetailUrl()).PHP_EOL;
                        if($has_children){
                            $traverse($category->children, $prefix,$level + 1);
                        }
                    }
                };
                $traverse($categories,'&#8211;');
            @endphp
        </ul>
    </div>
</aside>