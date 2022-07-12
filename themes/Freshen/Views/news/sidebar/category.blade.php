<?php
$categories = \Modules\News\Models\NewsCategory::search()->with(['translation'])->withCount('news')->get()->toTree();
if(!$categories) return;
if(!isset($current_cat)) $current_cat = null;
?>
<div class="terms_condition_widget">
    <h4 class="title">{{$widget['title'] ?? __('Categories')}}</h4>
    <div class="widget_list">
        <ul class="list_details">
            @php
                    $traverse = function ($categories, $prefix = '',$level = 0) use (&$traverse,$current_cat) {
                        foreach ($categories as $category) {
                            $translate = $category->translate(app()->getLocale());
                            $has_children = count($category->children);
                            $selected = '';
                            if((isset($current_cat) and $category->id == $current_cat->id)){
                                $selected = 'active';
                            }
                            printf('<li class="%s"><a href="%s" class="c-333333">'.($level ? str_repeat($prefix,$level).' ':'').$translate->name.'<span class="float-end">'.$category->news_count.'</span></a></li>',$selected,$category->getDetailUrl()).PHP_EOL;
                            if($has_children){
                                $traverse($category->children, $prefix,$level + 1);
                            }
                        }
                    };
                    $traverse($categories,'&#8211;');
            @endphp
        </ul>
    </div>
    <hr>
</div>
