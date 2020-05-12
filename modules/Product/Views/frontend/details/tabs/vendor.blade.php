<div class="product-vendor">
    <h2>{{$row->author->getDisplayName()}}</h2>
    <p>{{__($row->author->bio)}}</p>
    <p><a href="#">More Products from {{$row->author->getDisplayName()}}</a></p>
</div>
