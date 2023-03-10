@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="mb40">
            <div class="d-flex justify-content-between">
                <h1 class="title-bar">{{ __("Shipping Method") }}</h1>
            </div>
            <hr>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="{{ route('product.shipping.edit', ['id' => $zone_id]) }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i> {{ __("Zone") }}: {{ $shippingZone->name ?? __("Locations not covered by your other zones") }}</a>
            </div>
            <div class="col-md-12">
                <form action="{{ route('product.shipping.method.store') }}" method="post" autocomplete="off">
                    @csrf
                    @include('Language::admin.navigation')
                    <div class="lang-content-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="">{{__("Method title")}} <span class="text-danger">*</span></label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" required name="title" value="{{ $translation->title ?? old('title') }}">
                                            </div>
                                        </div>
                                        @if(is_default_lang())
                                            <div class="form-group">
                                                <label class="">{{__("Order No.")}}</label>
                                                <div class="form-controls">
                                                    <input type="number" class="form-control" name="order" value="{{ $row->order ?? old('order', 1) }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("Choose Shipping method")}}</label>
                                                <div class="form-controls">
                                                    <select class="form-control" name="method_id">
                                                        <option value="flat_rate" @if(($row->method_id ?? '') == 'flat_rate') selected @endif >{{ __("Flat rate") }}</option>
                                                        <option value="free_shipping" @if(($row->method_id ?? '') == 'free_shipping') selected @endif >{{ __("Free shipping") }}</option>
                                                        <option value="local_pickup" @if(($row->method_id ?? '') == 'local_pickup') selected @endif >{{ __("Local pickup") }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group" data-condition="method_id:not(free_shipping)">
                                                <label class="">{{__("Cost")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="cost" value="{{ $row->cost ?? 0 }}">
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
                        <input type="hidden" name="is_enabled" value="{{ $row->is_enabled ?? 1 }}" />
                        <input type="hidden" name="zone_id" value="{{ $zone_id ?? '' }}" />
                        <input type="hidden" name="zone_method_id" value="{{ $row->id ?? '' }}" />
                        <button class="btn btn-primary" type="submit">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
