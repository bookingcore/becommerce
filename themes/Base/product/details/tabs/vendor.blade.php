<div class="product-vendor">
    <h5>{{$row->author->getDisplayName()}}</h5>
    <p>{{__($row->author->bio)}}</p>
    <p><a href="#">More Products from {{$row->author->getDisplayName()}}</a></p>
</div>