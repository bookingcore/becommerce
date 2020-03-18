@php
    $list_category = $model_category->with('translations')->get()->toTree();
@endphp
@if(!empty($list_category))
    <div id="categories-2" class="widget widget_categories">
        <h4 class="widget-title">{{ $item->title }}</h4>
        <ul>
            <?php
            $traverse = function ($categories, $prefix = '') use (&$traverse) {
            foreach ($categories as $category) {
            $translation = $category->translateOrOrigin(app()->getLocale());
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
