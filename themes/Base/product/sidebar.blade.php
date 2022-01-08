<div class="widget widget_shop">
    <h4 class="widget-title">{{__('Categories')}}</h4>
    <ul class="bc-list--categories">
        @if(!empty($categories))
            @php
                $traverse = function ($categories, $prefix = '') use (&$traverse) {
                    foreach ($categories as $category) {
                        $translate = $category->translate(app()->getLocale());
                        $has_children = count($category->children);
                        if(empty($prefix)){
                            echo '<li class="cat-item '.($has_children ? 'menu-item-has-children' : '').'">';
                            echo '<a href="'.$category->getDetailUrl().'">'.e($translate->name).'</a>';
                            if($has_children){
                                echo '<span class="sub-toggle"><i class="fa fa-angle-down"></i></span>';
                            }
                        }else{
                            echo '<li class="cat-item">';
                            echo '<a href="'.$category->getDetailUrl().'">'.$translate->name.'</a>';
                        }
                        if($has_children){
                            echo '<ul class="sub-menu">';
                                $traverse($category->children, 1);
                            echo '</ul>';
                        }
                        echo '</li>';
                    }
                };
                $traverse($categories);
            @endphp
        @endif
    </ul>
</div>
<div class="widget widget_shop">
    @include('product.filter.brand')
    @include('product.filter.price')
    @include('product.filter.review')
    @include('product.filter.attributes')
</div>
