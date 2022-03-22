@if(!empty($categories))
<div class="widget widget_shop bg-f1f1f1 c-000000 p-3 pb-2 rounded">
    <h4 class="widget-title fs-22 mb-2">{{__('Categories')}}</h4>
    <ul class="list-unstyled ps-0 mt-3">
        @php
            $traverse = function ($categories, $prefix = '') use (&$traverse) {
                foreach ($categories as $category) {
                    $translate = $category->translate(app()->getLocale());
                    $has_children = count($category->children);
                    if(empty($prefix)){
                        echo '<li class="mb-1 cat-item mb-1 d-flex justify-content-between flex-wrap '.($has_children ? 'menu-item-has-children' : '').'">';
                        echo '<a class="c-000000 mb-2" href="'.$category->getDetailUrl().'">'.e($translate->name).'</a>';
                    }else{
                        echo '<li class="cat-item mb-1 d-flex justify-content-between flex-wrap">';
                        echo '<a class="c-000000" href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                    }
                    if($has_children){
                        echo '<span class="sub-toggle"  data-bs-toggle="collapse" data-bs-target="#cat-'.$category->id.'" aria-expanded="true"><i class="fa fa-angle-down"></i></span>';
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
<div class="widget widget_shop bg-f1f1f1 c-000000 p-3 pb-2 rounded">
    @include('product.filter.brand')
    @include('product.filter.review')
    @include('product.filter.attributes')
</div>
