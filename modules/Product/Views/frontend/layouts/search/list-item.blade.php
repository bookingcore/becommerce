<div class="row">
    <div class="col-lg-9 col-md-12">
        <div class="bravo-block-item bravo-block-list-item-carousel" >
            <div class="block-title">
                <h2 class="title">Recommended Items</h2>
                <div class="slick-arrows">
                    <span class="icon-chevron-left slick-prev-arrow slick-arrow slick-disabled" aria-disabled="true" style="display: inline;"></span>
                    <span class="icon-chevron-right slick-next-arrow slick-arrow" aria-disabled="false" style="display: inline;"></span>
                </div>
            </div>
            <div class="list-item">
                @if($rows->total() > 0)
                    @foreach($rows as $row)
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                    @endforeach
                @endif
            </div>
        </div>
        <div class="bravo-block-item bravo-block-list-item-carousel" >
            <div class="block-title">
                <h2 class="title">Best Seller Items
                </h2>
                <div class="slick-arrows">
                    <span class="icon-chevron-left slick-prev-arrow slick-arrow slick-disabled" aria-disabled="true" style="display: inline;"></span>
                    <span class="icon-chevron-right slick-next-arrow slick-arrow" aria-disabled="false" style="display: inline;"></span>
                </div>
            </div>
            <div class="list-item">
                @if($rows->total() > 0)
                    @foreach($rows as $row)
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                        @include('Product::frontend.loop.item')
                    @endforeach
                @endif
            </div>
        </div>
        <div class="bravo-list-item">
            <div  class="products-search-topbar">
                <div class="products-found">
                   <span>
                        @if($rows->total() > 1)
                           {{ __(":count tours found",['count'=>$rows->total()]) }}
                       @else
                           {{ __(":count tour found",['count'=>$rows->total()]) }}
                       @endif
                   </span>
                </div>
                    <div class="products-view"><span>View</span>
                        <a href="#" class="grid-view products-view-item current" data-view="grid"><i class="icon-grid"></i></a>
                        <a href="#" class="list-view products-view-item" data-view="list"><i class="icon-list4"></i></a>
                    </div>
                        <a href="#" class="d-sm-block d-md-none" id="mf-filter-mobile"><i class="icon-equalizer"></i><span>Filter</span></a>
                <ul class="products-ordering">
                    <li class="current"><span> Sort by latest</span>
                        <ul>
                            <li><a href="http://demo2.drfuri.com/martfury3/shop/?orderby=popularity" class="">Sort by popularity</a></li>
                            <li><a href="http://demo2.drfuri.com/martfury3/shop/?orderby=rating" class="">Sort by average rating</a></li>
                            <li><a href="http://demo2.drfuri.com/martfury3/shop/?orderby=date" class="active">Sort by latest</a></li>
                            <li><a href="http://demo2.drfuri.com/martfury3/shop/?orderby=price" class="">Sort by price: low to high</a></li>
                            <li><a href="http://demo2.drfuri.com/martfury3/shop/?orderby=price-desc" class="">Sort by price: high to low</a>
                            </li>
                        </ul>
                    </li>
                    <li class="cancel-ordering">
                        <a href="#" class="mf-cancel-order">Cancel</a>
                    </li>
                </ul>
            </div>
            <div class="list-item">
                <div class="row">
                    @if($rows->total() > 0)
                        @foreach($rows as $row)
                            <div class="col-lg-2 col-md-6">
                                @include('Product::frontend.loop.item')
                            </div>
                            <div class="col-lg-2 col-md-6">
                                @include('Product::frontend.loop.item')
                            </div>
                            <div class="col-lg-2 col-md-6">
                                @include('Product::frontend.loop.item')
                            </div>
                            <div class="col-lg-2 col-md-6">
                                @include('Product::frontend.loop.item')
                            </div>
                            <div class="col-lg-2 col-md-6">
                                @include('Product::frontend.loop.item')
                            </div>
                            <div class="col-lg-2 col-md-6">
                                @include('Product::frontend.loop.item')
                            </div>
                        @endforeach
                    @else
                        <div class="col-lg-12">
                            {{__("Product not found")}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="bravo-pagination">
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
</div>
