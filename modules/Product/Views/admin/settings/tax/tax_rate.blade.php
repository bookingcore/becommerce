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
                <a href="/admin/module/core/settings/index/tax" class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i> {{ __("Tax settings") }}</a>
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
                                        @if(is_default_lang())
                                            <div class="form-group">
                                                <label class="">{{__("Tax rate class")}}</label>
                                                <div class="form-controls">
                                                    <select class="form-control" name="tax_rate_class">
                                                        <option value="standard" @if(($taxRate->tax_rate_class ?? old('tax_rate_class')) == 'standard') selected @endif>{{ __("Standard") }}</option>
                                                        <option value="reduced_rate" @if(($taxRate->tax_rate_class ?? old('tax_rate_class')) == 'reduced_rate') selected @endif>{{ __("Reduced rate") }}</option>
                                                        <option value="zero_rate" @if(($taxRate->tax_rate_class ?? old('tax_rate_class')) == 'zero_rate') selected @endif>{{ __("Zero rate") }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("Country code")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="country_code" value="{{ $row->country_code ?? old('country_code') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("State code")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="state" value="{{ $row->state ?? old('state') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("Postcode / ZIP")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="postcode" value="{{ $taxRate->locationPostcodes->location_code ?? old('postcode') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("City")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="city" value="{{ $taxRate->locationCities->location_code ?? old('city') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("Rate %")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="tax_rate" value="{{ $taxRate->tax_rate ?? old('tax_rate') }}">
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label class="">{{__("Tax name")}}</label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" name="name" value="{{ $transition->name ?? old('name') }}">
                                            </div>
                                        </div>
                                        @if(is_default_lang())

                                            <div class="form-group">
                                                <label class="">{{__("Priority")}}</label>
                                                <div class="form-controls">
                                                    <input type="number" class="form-control" name="priority" value="{{ $taxRate->priority ?? old('priority') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-controls">
                                                    <input type="checkbox" class="form-control" name="compound" @if(($taxRate->compound ?? old('compound')) == 1) checked @endif value="1"> {{__("Compound")}}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-controls">
                                                    <input type="checkbox" class="form-control" name="shipping" @if(($taxRate->shipping ?? old('shipping')) == 1) checked @endif value="1"> {{__("Shipping")}}
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
                        <input type="hidden" name="id" value="{{ $taxRate->id ?? '' }}" />
                        <button class="btn btn-primary" type="submit">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
