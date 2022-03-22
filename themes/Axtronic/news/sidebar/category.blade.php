<?php
$categories = \Modules\News\Models\NewsCategory::search()->with(['translation'])->get()->toTree();
if(!$categories) return;
if(!isset($current_cat)) $current_cat = null;
?>
<aside class="widget widget-categories">
    <h3 class="widget_title">{{__('Categories')}}</h3>
    <div class="widget_content">
        <ul class="list-unstyled">
            @php
                $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                    foreach ($categories as $category) {
                        $translate = $category->translate(app()->getLocale());
                        $has_children = count($category->children);
                        $selected = '';
                        if((isset($current_cat) and $category->id == $current_cat->id)){
                            $selected = 'active';
                        }
                        printf('<li class="%s"><a href="%s"><span class="cat-name">'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'</span><span class="cat-count">'.$has_children.'</span></a></li>',$selected,$category->getDetailUrl()).PHP_EOL;
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
