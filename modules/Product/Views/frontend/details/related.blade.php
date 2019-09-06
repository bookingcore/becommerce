<?php
	/**
	 * Created by PhpStorm.
	 * User: Admin
	 * Date: 8/23/2019
	 * Time: 1:27 PM
	 */
?>
@if(!empty($related_list))
	<h2 class="box-title">{{__('Related products')}}</h2>
    <div class="product-related">
		<ul class="slides">
        @foreach($related_list as $row)
            <li>
				@include('Product::frontend.loop.item')
			</li>
        @endforeach
		</ul>
	</div>
@endif
