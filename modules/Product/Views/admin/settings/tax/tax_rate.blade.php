@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="mb40">
            <div class="d-flex justify-content-between">
                <h1 class="title-bar">{{ __("Tax rate") }}</h1>
            </div>
            <hr>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="/admin/module/core/settings/tax" class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i> {{ __("Tax settings") }}</a>
            </div>
            <div class="col-md-12">
                <form action="{{ route('product.tax.store') }}" method="post" autocomplete="off">
                    @csrf
                    @include('Language::admin.navigation')
                    <div class="lang-content-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="">{{__("Tax name")}}</label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" name="name" value="{{ $transition->name ?? old('name') }}">
                                            </div>
                                        </div>
                                        @if(is_default_lang())
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">{{__("Country code")}}</label>
                                                        <div class="form-controls">
                                                            <select name="country" class="form-control">
                                                                <option value="*">*</option>
                                                                @foreach(get_country_lists() as $key=>$value)
                                                                    <option value="{{ $key }}" @if( ($row->country ?? old('country')) == $key ) selected @endif> {{$value}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">{{__("Priority")}}</label>
                                                        <div class="form-controls">
                                                            <input type="number" class="form-control" name="priority" value="{{ $row->priority ?? old('priority') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">{{__("State code")}}</label>
                                                        <div class="form-controls">
                                                            <input type="text" class="form-control" name="state" value="{{ $row->state ?? old('state') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">{{__("Postcode / ZIP")}}</label>
                                                        <div class="form-controls">
                                                            <input type="text" class="form-control" name="postcode" value="{{ $row->postcode ?? old('postcode') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">{{__("City")}}</label>
                                                        <div class="form-controls">
                                                            <input type="text" class="form-control" name="city" value="{{ $row->city ?? old('city') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="">{{__("Rate %")}}</label>
                                                        <div class="form-controls">
                                                            <input type="text" class="form-control" name="tax_rate" value="{{ $row->tax_rate ?? old('tax_rate', 1) }}">
                                                        </div>
                                                    </div>
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
                        <input type="hidden" name="id" value="{{ $row->id ?? '' }}" />
                        <button class="btn btn-primary" type="submit">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
