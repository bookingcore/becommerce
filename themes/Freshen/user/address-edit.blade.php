@extends('layouts.app')
@section('content')
     @include('global.breadcrumb')
    <section class="bc-section-account mb-3 mt-3 fz14">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('user.sidebar')
                </div>
                <div class="col-lg-8">
                    <div class="bc-content">
                        @include('global.message')
                        <form action="{{route('user.address.store',['type'=>$type])}}" method="post">
                            @csrf
                            <div class="bc-section--account-setting">
                                <div class="bc-section__header">
                                    <h3>{{$page_title}}</h3>
                                </div>
                                <div class="bc-section__content">
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
    </section>
@endsection
@section("footer")
    <script>
        $('.bc-select2').select2()
    </script>
@endsection
