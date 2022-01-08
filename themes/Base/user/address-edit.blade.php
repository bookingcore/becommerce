@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="bc-section--account">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="bc-section__left">
                        @include('user.sidebar')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="bc-section__right">
                        @include('global.message')
                        <form action="{{route('user.address.store',['type'=>$type])}}" method="post">
                            @csrf
                            <div class="bc-section--account-setting">
                                <div class="bc-section__header">
                                    <h3>{{$page_title}}</h3>
                                </div>
                                <div class="bc-section__content">
                                    @include("user.address.billing-form")
                                </div>
                                <div class="form-group submit">
                                    <button class="btn">{{__('Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script>
        $('.bc-select2').select2()
    </script>
@endsection
