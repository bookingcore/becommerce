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
                    <div class="fs-24 mb-3">
                        <h3>{{__("Update Account Information")}}</h3>
                    </div>
                    <div class="axtronic-content">
                        <form action="{{route('user.profile.store')}}" method="post">
                            @csrf
                            @include('global.message')
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label>{{__('First name')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="first_name" required value="{{old('first_name',$user->first_name ?? '')}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label>{{__('Last name')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="last_name" required value="{{old('last_name',$user->last_name ?? '')}}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3">
                                        <label>{{__('Display name')}} <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="business_name" value="{{old('business_name',$user->business_name ? $user->business_name : $user->display_name)}}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group mb-3 ">
                                        <label class="">
                                            {{__('Email')}} <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="email" required  value="{{old('email',$user->email ?? '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3 submit">
                                <button class="btn btn-primary">{{__('Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
