@if(!empty($row->same_brand))
    <div class="col-product-sidebar-item product-sidebar-same-brand">
        <h4 class="sidebar-item-title">{{__('Same Brand')}}</h4>
        <ul class="product_list_sidebar">
            @foreach($row->same_brand as $item=>$row)
                <li>
                    @include('Product::frontend.loop.item-sidebar')
                </li>
            @endforeach
        </ul>
    </div>
@endif
