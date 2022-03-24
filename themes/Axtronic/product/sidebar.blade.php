@if(!empty($categories))
<div class="widget widget_shop">
    <h3 class="widget_title">{{__('Categories')}}</h3>
    <ul class="list-unstyled ps-0 mt-3">
        @php
            $traverse = function ($categories, $prefix = '') use (&$traverse) {
                foreach ($categories as $category) {
                    $translate = $category->translate(app()->getLocale());
                    $has_children = count($category->children);
                    if(empty($prefix)){
                        echo '<li class="mb-2 cat-item d-flex justify-content-between flex-wrap align-items-center '.($has_children ? 'menu-item-has-children' : '').'">';
                        echo '<a class="c-000000" href="'.$category->getDetailUrl().'">'.e($translate->name).'</a>';
                    }else{
                        echo '<li class="cat-item mb-2 d-flex justify-content-between flex-wrap">';
                        echo '<a class="c-000000" href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                    }
                    if($has_children){
                        echo '<span class="sub-toggle"  data-bs-toggle="collapse" data-bs-target="#cat-'.$category->id.'" aria-expanded="true"><i class="axtronic-icon-angle-down"></i></span>';
                    }
                    if($has_children){
                        echo '<ul class="collapse w-100" id="cat-'.$category->id.'">';
                            $traverse($category->children, 1);
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            };
            $traverse($categories);
        @endphp
    </ul>
</div>
@endif
<div class="widget widget_shop">
    @include('product.filter.price')
</div>
<div class="widget">
    @include('product.filter.brand')
</div>
<div class="widget">
    @include('product.filter.review')
</div>
<div class="widget">
    @include('product.filter.attributes')
</div>
