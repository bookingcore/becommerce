@extends('layouts.app')
@section('head')

@endsection
@section('content')
     @include('global.breadcrumb')
    <div class="axtronic-section-account mb-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-9">
                    <div class="fs-24 mb-3">
                        <h3>{{ __("Wishlist") }}</h3>
                    </div>
                    <div class="axtronic-content">
                        @include('admin.message')
                        @if($rows->total() > 0)
                            <div class="row mb-2">
                                @foreach($rows as $row)
                                    <div class="col-md-4 mb-3">
                                        @include('product.search.loop',['row'=>$row->service])
                                    </div>
                                @endforeach
                            </div>
                            <div class="axtronic-pagination d-flex justify-content-between">
                                <span class="count-string">{{ __("Showing :from - :to of :total",["from"=>$rows->firstItem(),"to"=>$rows->lastItem(),"total"=>$rows->total()]) }}</span>
                                {{$rows->appends(request()->query())->links()}}
                            </div>
                        @else
                            {{__("No Items")}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection