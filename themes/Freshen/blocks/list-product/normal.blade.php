@if(!empty($rows->count()))
    <div class="bc-list-products mb-5">
        <div class="container">
            <div class="mb-4">
                <h3 class="fs-24 mb-1">{{ $title }}</h3>
                <span class="fs-16">{{ $sub_title }}</span>
            </div>
            <div class="bc-content">
                <div class="row">
                    @if(!empty($rows))
                        @foreach($rows as $row)
                        <div class="col-lg-3 col-sm-6 mb-3">
                            @include('product.search.loop')
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
