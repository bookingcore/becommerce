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


                        <ul class="axtronic-products products">
                            @if($rows->total())
                                @foreach($rows as $row)
                                    <li class="product">
                                        @include("product.search.loop")
                                    </li>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="alert alert-warning" role="alert">
                                        {{__("No Product")}}
                                    </div>
                                </div>
                            @endif
                        </ul>
                        <div class="axtronic-pagination">
                            {{$rows->links()}}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
