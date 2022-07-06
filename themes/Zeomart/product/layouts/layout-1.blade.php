<form action="" class="bc_form_filter">
    <div class="gap-4 lg:flex">
        <div class="w-full lg:w-1/4">
            @include("product.sidebar")
        </div>
        <div class="w-full lg:w-3/4">
            @include("product.search.header")
            <div class="mt-6 grid lg:grid-cols-4 border border-slate-200 border-r-0 border-b-0">
                @if($rows->total())
                    @foreach($rows as $row)
                        <div class="p-5 border-slate-200 border-r border-b border-solid">
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
            <div class="bc-pagination">
                {{$rows->withQueryString()->links()}}
            </div>
        </div>
    </div>
</form>
