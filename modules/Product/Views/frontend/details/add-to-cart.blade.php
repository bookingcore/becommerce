<div class="product-detail-add-to-cart">
    <div class="actions">
        <div class="quantity-input">
            <label>{{__('Quantity')}}</label>
            <div class="quantity-input-group">
                <span class="minus"><i class="icon_minus-06"></i></span>
                <input type="number" min="1" max="100">
                <span class="plus"><i class="icon_plus"></i></span>
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