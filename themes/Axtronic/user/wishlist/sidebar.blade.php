<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 4/9/2022
 * Time: 4:31 PM
 */
$items = \Modules\User\Models\UserWishList::query()
    ->where("user_wishlist.user_id",Auth::id())
    ->orderBy('user_wishlist.id', 'desc')->GET();
?>

<div class="site-wishlist-side side-wrap">
    <a href="#" class="close-wishlist-side close-side"><span class="screen-reader-text">{{__('Close')}}</span></a>
    <div class="cart-side-heading side-heading">
        <span class="cart-side-title side-title">{{__('Wishlist')}}</span>
    </div>
    <div class="wishlist-side-wrap-content side-wrap-content">
        <div class="axtronic-content-scroll">
            <div class="axtronic-wishlist-content content-loaded">
                @if(!empty($items))
                    <ul class="nav list-items list-product-items">
                        @foreach($items as $item)
                            @php(
                                $item1 = $item->service
                            )
                            <li class="list-item product-item">
                                @include('product.search.loop',['row'=>$item->service])
                                {{--<a href="" class="remove remove_button">×</a>--}}
                            </li>
                        @endforeach
                    </ul>
                @else
                    {{--Danh sách wishlist trống--}}
                    <div class="axtronic-content-mid-notice">
                        {{__('There are no products on the wishlist!')}}
                    </div>
                @endif

            </div>
        </div>
        <div class="axtronic-wishlist-bottom">
            <a class="button" href="/user/wishlist">{{__('Wishlist page')}}</a>
        </div>
    </div>
</div>
<div class="wishlist-side-overlay side-overlay"></div>
