<div class="ps-tabs">
    <div class="ps-tab active" id="tab-1">
        <div class="ps-shopping-product">
            <div class="row">
                @foreach($rows as $row)
                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-6 ">
                        @include("product.search.loop-item")
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
