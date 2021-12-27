@php
    $list_category = $model_category->with('translations')->get()->toTree();
@endphp
@if(!empty($list_category))
<div class="sidebar-widget widget_category">
    <div class="sidebar-title">
        <h4>{{ $item->title }}</h4>
    </div>
    <ul class="catagory-list">
        <?php
        $traverse = function ($categories, $prefix = '') use (&$traverse) {
            foreach ($categories as $category) {
                $translation = $category->translate(app()->getLocale());
                ?>
                    <li>
                        <span></span>
                        <a href="{{ $category->getDetailUrl() }}">{{$prefix}} {{$translation->name}}</a>
                    </li>
                <?php
                $traverse($category->children, $prefix . '-');
            }
        };
        $traverse($list_category);
        ?>
    </ul>
</div>
@endif
