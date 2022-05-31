@extends("layouts.app")
@section('content')
     @include('global.breadcrumb')
    <div class="bc-page--shop" id="shop-sidebar">
        <div class="container">
            <form action="" class="bc_form_filter">
                <div class="row">
                    <div class="col-md-3">
                        @include("product.sidebar")
                    </div>
                    <div class="col-md-9">
                        @include("product.search.header")
                        <div class="row py-3">
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
                        <div class="bc-pagination">
                            {{$rows->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
