<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/15/2022
 * Time: 9:48 AM
 */
?>
<section class="collection-list__box">
    <div class="container">
        <div class="collection-list--image collection-effect__image  collection-list-{{count($list_items)}}">
            @foreach($list_items as $k =>$item)
                @if( !empty( $item_cat =  $categories->firstWhere('id',$item['category_id']) ))
                    @php
                        $translate = $item_cat->translate(app()->getLocale());
                        $page_search = $item_cat->getDetailUrl();
                        $image_url = get_file_url($item['image_id'] ?? "", 'full');

                        $list_items = $list_product_cat[ $item_cat->id ] ?? [];
                    @endphp
                    <figure>
                        <img src="{{  $image_url }}" alt=" {{ $translate->name }}">
                        <figcaption>
                            <a href="{{$page_search}}">
                                <h5>{{ $translate->name }}</h5>
                                <p> {{ count($list_items) }} {{ count($list_items) > 1 ? 'products' : 'product' }}</p>
                            </a>
                        </figcaption>
                    </figure>
                @endif
            @endforeach
        </div>
    </div>
</section>
