<div class="row">
    @if($rows->total())
        @foreach($rows as $row)
            <div class="col-sm-4 mb-3">
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