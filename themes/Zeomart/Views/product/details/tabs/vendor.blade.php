<div class="product-vendor">
    <h5>{{$row->author->display_name}}</h5>
    <p>{{__($row->author->bio)}}</p>
    <p><a href="{{ $row->author->getStoreUrl() }}">{{ __("More Products from :address", ['address'=>$row->author->display_name]) }}</a></p>
</div>
