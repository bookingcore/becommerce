<?php
	/**
	 * Created by PhpStorm.
	 * User: Admin
	 * Date: 8/23/2019
	 * Time: 1:27 PM
	 */
?>
@if(!empty($related_list))
    <div class="product-related">
        <h2 class="box-title">{{__('Related products')}}</h2>
		<ul class="products list-unstyled">
        @foreach($related_list as $row)
            <li class="product type-product">
				@include('Product::frontend.loop.item')
			</li>
        @endforeach
		</ul>
	</div>
@endif
