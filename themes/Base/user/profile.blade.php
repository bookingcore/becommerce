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
                        <form action="{{route('user.profile.store')}}" method="post">
                            @csrf
                            <div class="bc-section--account-setting">
                                <div class="bc-section__header">
                                    <h3>{{__("Update Account Information")}}</h3>
                                </div>
                                <div class="bc-section__content">
                                    @include('global.message')
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('First name')}} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="first_name" required value="{{old('first_name',$user->first_name ?? '')}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Last name')}} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="last_name" required value="{{old('last_name',$user->last_name ?? '')}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>{{__('Display name')}} <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="business_name" value="{{old('business_name',$user->business_name ? $user->business_name : $user->display_name)}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label class="">
                                                    {{__('Email')}} <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" name="email" required  value="{{old('email',$user->email ?? '')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button class="btn">{{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
