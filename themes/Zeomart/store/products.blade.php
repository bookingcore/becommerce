
<div id="listProduct" class="grid grid-cols-2 xl:grid-cols-5 gap-0">
    @if($rows->total())
        @foreach($rows as $row)
            <div class="border p-3">
                @include("product.search.loop")
            </div>
        @endforeach
    @else
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                {{__("No Product")}}
            </div>
        </div>
    @endif
</div>
