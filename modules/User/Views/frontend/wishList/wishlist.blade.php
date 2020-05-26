@extends('layouts.app')
@section('head')

@endsection
@section('content')
    <div class="wishList-page">
        <h1 class="entry-title">Wishlist</h1>
        <div class="site-content">
            <div class="container">
                <div class="row">
                    <div id="primary" class="content-area col-md-12">
                        <div class="wishlist-message" role="alert">
                            Product successfully removed.
                        </div>

                        <table class="shop_table cart wishlist_table wishlist_view traditional responsive">
                            <thead>
                                <tr>
                                    <th class="product-remove"><span class="nobr"></span></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name"><span class="nobr">{{__('Product name')}}</span></th>
                                    <th class="product-price"><span class="nobr">{{__('Unit price')}}</span></th>
                                    <th class="product-stock-status"><span class="nobr">{{__('Stock status')}}</span></th>
                                    <th class="product-add-to-cart"><span class="nobr"></span></th>
                                </tr>
                            </thead>

                            <tbody class="wishlist-items-wrapper">
                                @if($rows->total() > 0)
                                    @foreach($rows as $row)
                                        @include('User::frontend.wishlist.loop-list')
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="wishlist-empty">{{__('No products added to the wishlist')}}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="wishlist-pagination">
                            {{$rows->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection
