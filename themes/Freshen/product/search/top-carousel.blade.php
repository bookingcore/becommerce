@if(!empty($rows))
    <div class="recent_property_slider_home5">
        @foreach($rows as $row)
            <div class="item">
                @includeIf('product.search.product.search.top-carousel')
            </div>
        @endforeach
    </div>
@endif

