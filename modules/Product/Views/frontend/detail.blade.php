@extends('layouts.app')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset("libs/fotorama/fotorama.css") }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("module/product/css/produc.css") }}"/>
@endsection
@section('content')
    @if(!empty($product_style) and view()->exists('Product::frontend.styles.'.$product_style))
        @include('Product::frontend.styles.'.$product_style)
    @else
        @include('Product::frontend.styles.default')
    @endif
@endsection

@section('footer')
    <script>
        var bravo_booking_data = {!! json_encode($booking_data) !!}
        var bravo_booking_i18n = {
			no_date_select:'{{__('Please select Start and End date')}}',
            no_guest_select:'{{__('Please select at lease one guest')}}',
        };
    </script>
    <script type="text/javascript" src="{{ asset("libs/ion_rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/fotorama/fotorama.js") }}"></script>
    <script type="text/javascript" src="{{ asset("libs/sticky/jquery.sticky.js") }}"></script>
@endsection
