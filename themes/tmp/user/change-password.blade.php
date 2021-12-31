@extends('layouts.app')
@section('content')
    @include('global.bc')
    <div class="ps-section--account">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ps-section__left">
                        @include('user.sidebar')
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ps-section__right">
                        <form action="{{route('user.password.store')}}" method="post">
                            @csrf
                            <div class="ps-section--account-setting">
                                <div class="ps-section__header">
                                    <h3>{{__("Change Password")}}</h3>
                                </div>
                                <div class="ps-section__content">
                                    @include('global.message')
                                    <div class="form-group">
                                        <label>{{__("Current Password")}}</label>
                                        <input type="password" name="current-password" required placeholder="{{__("Current Password")}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__("New Password")}}</label>
                                        <input type="password" name="new-password" required minlength="6" placeholder="{{__("New Password")}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>{{__("New Password Again")}}</label>
                                        <input type="password" name="new-password_confirmation" required minlength="6" placeholder="{{__("New Password Again")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group submit">
                                    <button class="ps-btn">{{__('Save changes')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
