@extends("layouts.app")
@section('content')
     @include('global.breadcrumb')
    <div class="axtronic-page--shop" id="shop-sidebar">
        <div class="container">
            <form action="" class="axtronic_form_filter">
                <div class="row">
                    <div class="col-md-3">
                        @include("product.sidebar")
                    </div>
                    <div class="col-md-9">

                        @include("blocks.banner.index")

                        @include("product.search.header")
                        @if($rows->total())
                            <ul class="axtronic-products products">
                                @foreach($rows as $row)
                                    <li class="product">
                                        @include("product.search.loop")
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="alert alert-warning d-block">{{__("No Product")}}</span>
                        @endif
                        <div class="axtronic-pagination">
                            {{$rows->links()}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
