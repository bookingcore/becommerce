@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="mb40">
            <div class="d-flex justify-content-between">
                <h1 class="title-bar">{{ __("Shipping Zone") }}</h1>
            </div>
            <hr>
        </div>
        @include('admin.message')
        <div class="row">

            <div class="col-md-12">
                <form action="{{ route('product.shipping.store') }}" method="post" autocomplete="off">
                    @csrf

                    @include('Language::admin.navigation')

                    <div class="lang-content-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="">{{__("Zone name")}} <span class="text-danger">*</span></label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" required name="zone_name" value="{{setting_item_with_lang('zone_name',request()->query('lang'))}}">
                                            </div>
                                        </div>
                                        @if(is_default_lang())
                                            <div class="form-group">
                                                <label class="">{{__("Zone regions")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="zone_name" value="{{setting_item('zone_name')}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("Order No.")}}</label>
                                                <div class="form-controls">
                                                    <input type="number" class="form-control" name="order" value="{{ $row->order ?? 1 }}">
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <button class="btn btn-primary" type="submit">{{__('Save settings')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
