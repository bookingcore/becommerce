@extends('layouts.app')
@section('content')
    <h1 class="entry-title">{{ __('Your Recently Viewed') }}</h1>
    <div class="recent-list">
        <div class="container">
            <ul class="products list-unstyled row">
                @if(!empty($rows))
                    @foreach($rows as $row)
                        @include('Product::frontend.layouts.product')
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection
