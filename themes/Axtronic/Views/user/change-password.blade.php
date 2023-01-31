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
                        <form action="{{route('user.password.store')}}" method="post">
                            @csrf
                            <div class="axtronic-section--account-setting">
                                <div class="axtronic-section__header">
                                    <h3>{{__("Change Password")}}</h3>
                                </div>
                                <div class="axtronic-section__content">
                                    @include('global.message')
                                    <div class="form-group mb-3">
                                        <label>{{__("Current Password")}}</label>
                                        <input type="password" name="current-password" required placeholder="{{__("Current Password")}}" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>{{__("New Password")}}</label>
                                        <input type="password" name="new-password" required minlength="6" placeholder="{{__("New Password")}}" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>{{__("New Password Again")}}</label>
                                        <input type="password" name="new-password_confirmation" required minlength="6" placeholder="{{__("New Password Again")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group mb-3 submit">
                                    <button class="btn btn-primary">{{__('Save changes')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
