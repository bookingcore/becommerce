@if(!empty($productTopSearchPage))
    <div class="row">
        <div class="col-lg-12">
            <div class="recent_property_slider_home5">
                @foreach($productTopSearchPage as $row)
                    <div class="item">
                        @includeIf('product.search.loop')
                    </div>
                @endforeach
            </div>
            <hr class="mb30">
        </div>
    </div>
@endif
