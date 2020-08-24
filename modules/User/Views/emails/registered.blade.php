@extends('Email::layout')
@section('content')
    <div class="b-container">
        <div class="b-panel">
            {!! clean($content) !!}
        </div>
    </div>
@endsection
