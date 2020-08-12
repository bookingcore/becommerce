<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/23/2019
 * Time: 10:28 AM
 */
?>
@if($row->getGallery())
    <div  class="product-detail-gallery flexslider">
        <ul class="slides">
            @foreach($row->getGallery() as $key=>$item)
                <li data-thumb="{{$item['thumb']}}">
                    <img src="{{$item['large']}}" />
                </li>
            @endforeach
        </ul>
    </div>
@endif
