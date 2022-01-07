<div class="product-vendor">
    <h4>{{$row->author->getDisplayName()}}</h4>
    <p>{{__($row->author->bio)}}</p>
    <p><a href="#">More Products from {{$row->author->getDisplayName()}}</a></p>
</div>