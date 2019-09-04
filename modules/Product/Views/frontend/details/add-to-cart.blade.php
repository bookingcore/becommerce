<div class="product-detail-add-to-cart">
    <div class="actions clearfix">
        <div class="quantity-input my-3">
            <label>{{__('Quantity')}}</label>
            <div class="quantity-input-group">
                <span class="minus"></span>
                <input type="number" min="1" max="100">
                <span class="plus"></span>
            </div>
        </div>
        <a href="#" onclick="return false" class="add_to_cart btn btn-dark btn-action">{{__('Add to cart')}}</a>
        <a href="#" onclick="return false" class="buy_now btn btn-primary btn-action">{{__('Buy now')}}</a>
        <a href="#" onclick="return false" class="add_wishlist btn-action" data-tooltip="{{__('Add to Wishlist')}}">
            <i class="icon-heart"></i>
        </a>
        <a href="#" onclick="return false" class="add_compare btn-action" data-tooltip="{{__('Compare')}}">
            <i class="icon-chart-bars"></i>
        </a>
    </div>
</div>