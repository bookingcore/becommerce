<form action="" class="bc_form_filter">
    <div class="row">
        <div class="col-md-12">
            @include("product.search.header",['show_filter'=>true])
            <div class="row py-3">
                @if($rows->total())
                @foreach($rows as $row)
                    @if($listing_list_style=='list')
                        <div class="col-12">
                            @includeIf("product.search.loop-list")
                        </div>
                    @else
                        <div class="col-sm-3 mb-3">
                            @include("product.search.loop")
                        </div>
                    @endif

                @endforeach
                @else
                <div class="col-md-12">
                    <div class="alert alert-warning" role="alert">
                        {{__("No Product")}}
                    </div>
                </div>
                @endif
            </div>
            <div class="bc-pagination mb-5">
                {{$rows->links()}}
            </div>
        </div>
    </div>
</form>
