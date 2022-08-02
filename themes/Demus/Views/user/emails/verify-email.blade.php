@extends('layouts.email')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            <h3>{{__('Hello!')}}</h3>
            <p>{{__('Please click the button below to verify your email address.')}}</p>
            <p style="text-align: center">
                <a href="{{$url}}" class="btn btn-primary">{{__('Verify Email Address')}}</a>
            </p>
            <p>{{__('If you did not create an account, no further action is required.')}}</p>
            <p>{{__('Regards,')}}</p>
            <p>{{setting_item('site_title')}}</p>
            <hr>
            <p>{{__("If you're having trouble clicking the verify button, copy and paste the URL below into your web browser:")}} <a href="{{$url}}" >{{$url}}</a></p>

        </div>
    </div>
@endsection
