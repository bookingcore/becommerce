@extends('layouts.app')
@section('content')
     @include('global.breadcrumb')
    <div class="axtronic-section-account mb-3 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="axtronic-content">
                        @include('global.message')
                        <form action="{{route('user.address.store',['type'=>$type])}}" method="post">
                            @csrf
                            <div class="axtronic-section--account-setting">
                                <div class="axtronic-section__header">
                                    <h3>{{$page_title}}</h3>
                                </div>
                                <div class="axtronic-section__content">
                                    @include("user.address.billing-form",['type'=>$type])
                                </div>
                                <div class="form-group submit">
                                    <button class="btn btn-success">{{__('Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push("footer")
    <script>
        $('.axtronic-select2').select2()
    </script>
@endpush
