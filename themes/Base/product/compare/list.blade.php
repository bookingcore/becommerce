<tbody class="text-center">
@if(!empty($compare))
    @php
        /*$c_remove = $c_image = $c_title = $c_price = $c_add = $c_desc = $stock = $brand = '';
        foreach ($compare as $row){
            $c_remove .= "<td class='text-center'><a href='#' class='bc_remove_compare' data-id='".$row['id']."'><span>".__('Remove')."</span></a></td>";
            $c_image .= "<td><div class='image-wrap text-center'>".get_image_tag($row['image_id'],'thumb',['lazy'=>false,'alt'=>e($row['title'])])."</div></td>";
            $c_title .= "<td>".e($row['title'])."</td>";
            $c_price .= "<td>";
            if ($row['product_type'] == 'variable'){
                if (!empty($priceRange = $row['v_price'])){
                    $c_price .= "<p class='price variable-price'>";
                    if ($priceRange['min'] == $priceRange['max']){
                        $c_price .= "<ins><span class='amount'>".format_money(e($priceRange['max']))."</span></ins>";
                    } else {
                        $c_price .= "<ins><span class='amount'>".format_money(e($priceRange['min']))."</span> - <span class='amount'>".format_money(e($priceRange['max']))."</span></ins>";
                    }
                    $c_price .= "</p>";
                }
            } else {
                if (!empty($row['sale_price'])){
                    $c_price .= "<p class='price has-sale'><ins><span class='amount'>".format_money(e($row['sale_price']))."</span></ins> <del><span class='amount'>".format_money(e($row['price']))."</span></del>";
                    if (!empty($row['discount_percent'])){
                        $c_price .= "<span class='sale'>(-".e($row['discount_percent']).")</span>";
                    }
                    $c_price .= "</p>";
                } else {
                    $c_price .= "<p class='price single-price'><ins><span class='amount'>".format_money(e($row['price']))."</span></ins></p>";
                }
            }
            $product_type = ($row['product_type'] == 'simple') ? __('Add to cart') : __('Select options');
            $product_slug = ($row['product_type'] == 'variable') ? 'href='.route('product.detail',['slug'=>e($row['slug'])]) : '';
            $product_data = ($row['product_type'] == 'simple') ? 'data-product={"id":'.$row['id'].',"type":"'.e($row['product_type']).'"}' : '';
            $add_to_cart = ($row['product_type'] == 'simple') ? 'core_add_to_cart' : '';
            if ($row['stock_status'] == 'in'){
                $c_add .= "<td><a $product_slug class='btn-add-to-cart $add_to_cart' $product_data>$product_type</a></td>";
            } else {
                $c_add .= "<td><a href=".route('product.detail',['slug'=>e($row['slug'])])." class='btn-add-to-cart out-of-stock'>".__('Read more')."</a></td>";
            }
            $c_desc .= "<td>".clean($row['short_desc'])."</td>";
            $stock_status = ($row['stock_status'] == 'in' ? __('In stock') : __('Out of stock'));
            $stock .= "<td class='text-center'><span>$stock_status</span></td>";
            $brand .= "<td class='text-center'>".e($row['brand_name'])."</td>";
        }*/
    @endphp
    <tr class="remove">
        <th></th>
        @foreach ($compare as $row)
            <td class="text-center">
                <a href="#" class="bc_remove_compare" data-id="{{ $row['id'] }}"><span>{{ __('Remove') }}</span></a>
            </td>
        @endforeach
    </tr>
    <tr class="image">
        <th></th>
        @foreach ($compare as $row)
            <td>
                {!! get_image_tag($row['image_id'],'thumb',['lazy'=>false,'alt'=>e($row['title'])]) !!}
            </td>
        @endforeach
    </tr>
    <tr class="title">
        <th></th>
        @foreach ($compare as $row)
            <td>{{ e($row['title']) }}</td>
        @endforeach
    </tr>
    <tr class="price">
        <th></th>
        @foreach ($compare as $row)
            <td>
                @dump($row)
                    100$
            </td>
        @endforeach
    </tr>
    <tr class="add-to-cart">
        <th></th>
        @foreach ($compare as $row)
            <td>Add To cart</td>
        @endforeach
    </tr>
    <tr class="description">
        <th>{{ __('Description') }}</th>
        @foreach ($compare as $row)
            <td class="text-start">{!! clean($row['short_desc']) !!}</td>
        @endforeach
    </tr>
    <tr class="stock">
        <th>{{ __('Availability') }}</th>
        @foreach ($compare as $row)
            <td class="text-center"> {{ ($row['stock_status'] == 'in' ? __('In stock') : __('Out of stock')) }} </td>
        @endforeach
    </tr>
    <tr class="stock">
        <th>{{ __('Brand') }}</th>
        @foreach ($compare as $row)
            <td class="text-center"> {{ e($row['brand_name'] ?? "") }} </td>
        @endforeach
    </tr>
    {{--@if(!empty($attributes = \Modules\Core\Models\Attributes::all()))
        @foreach($attributes as $item)
            <tr>
                <th>{{$item->name}}</th>
                @foreach($compare as $row)
                    <td>
                        @if(count($row['attrs']) > 0)
                            @foreach($row['attrs'] as $attr)
                                @if($item->id == $attr['id'])
                                    @php $name = '' @endphp
                                    @foreach($attr['term_id'] as $term)
                                        @php $name .= $term['name'].', ' @endphp
                                    @endforeach
                                    {{ substr($name,0,-2) }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
    @endif--}}
@else
    <tr class="no-products" role="row">
        <td>{{ __('No products added in the compare table') }}</td>
    </tr>
@endif
</tbody>