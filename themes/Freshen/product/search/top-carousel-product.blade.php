@if(!empty($rows))
    <div class="recent_property_slider_home5">
        @foreach($rows as $row)
            <div class="item">
                @includeIf('product.search.product.search.product.search.loop')
            </div>
        @endforeach
    </div>
@endif

