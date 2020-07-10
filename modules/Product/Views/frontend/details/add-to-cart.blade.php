@if($row->stock_status == 'in')
    <hr>
    <div class="product-detail-add-to-cart" id="product-detail-add-to-cart">
        <form class="actions clearfix" action="#">
            <div class="actions-cart">
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
                <button  class="btn btn btn-dark btn-action add_to_cart bravo_add_to_cart" {{ ($row->product_type == 'variable') ? 'disabled' : '' }} data-product='{!! json_encode(['id'=>$row->id,'type'=>$row->product_type])!!}'>{{__('Add to cart')}}</button>
                <button  class="btn buy_now btn btn-primary btn-action bravo_add_to_cart" {{ ($row->product_type == 'variable') ? 'disabled' : '' }} data-product='{!! json_encode(['id'=>$row->id,'type'=>$row->product_type,'buy_now'=>1])!!}'>{{__('Buy now')}}</button>
            </div>

            <div class="actions-button">
                @php $hasWishList = in_array($row->id, wishlist()) @endphp
                <div class="btn-custom">
                    <a href="{{route('user.wishList.index')}}" data-id="{{$row->id}}" data-type="{{$row->type}}" class="add_wishlist btn-action service-wishlist detal-wishlist {{ $hasWishList ? 'active' : ''}}" data-toggle="tooltip" title="{{ $hasWishList ? __('Brower to Wishlist') : __('Add to Wishlist')}}">
                        <i class="icon-heart"></i>
                        <span class="btn-text">{{ $hasWishList ? __('Brower to Wishlist') : __('Add to Wishlist') }}</span>
                    </a>
                </div>
                <div class="btn-custom">
                    <a href="#" onclick="return false" class="add_compare btn-action mf-compare-button {{ in_array($row->id, list_compare_id()) ? 'browse' : '' }}" data-toggle="tooltip" title="{{ in_array($row->id, list_compare_id()) ? __('Browse Compare') : __('Compare') }}" data-id="{{$row->id}}">
                        <i class="icon-chart-bars"></i>
                        <span class="btn-text">{{ in_array($row->id, list_compare_id()) ? __('Browse Compare') : __('Compare') }}</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endif
