<div class="product-detail-add-to-cart" id="product-detail-add-to-cart">
        <form class="actions clearfix" action="#">
            <input type="hidden" name="product_id" value="{{$row->id}}">
            @include('Product::frontend.details.variations')
            <div class="quantity-input">
                <label>{{__('Quantity')}}</label>
                <div class="quantity-input-group">
                    <span class="minus decrease">
                        <i class="icon-minus"></i></span>
                    <input name="quantity" type="number" min="1" max="100" value="1">
                    <span class="plus increase"><i class="icon-plus"></i></span>
                </div>
            </div>
            <button  class="btn add_to_cart btn btn-dark btn-action">{{__('Add to cart')}}</button>
            <button  class="btn buy_now btn btn-primary btn-action">{{__('Buy now')}}</button>
            <a href="#" onclick="return false" class="btn add_wishlist btn-action" data-toggle="tooltip" title="{{__('Add to Wishlist')}}">
                <i class="icon-heart"></i>
            </a>
            <a href="#" onclick="return false" class="btn add_compare btn-action" data-toggle="tooltip" title="{{__('Compare')}}">
                <i class="icon-chart-bars"></i>
            </a>
        </form>
</div>
