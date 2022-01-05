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
                <a href="{{ route('product.shipping.edit', ['id' => $zone_id]) }}" class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i> {{ $shippingZone->name ?? __("Locations not covered by your other zones") }}</a>
            </div>

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
                                            <label class="">{{__("Method title")}} <span class="text-danger">*</span></label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" required name="title" value="{{ $row->title ?? old('title') }}">
                                            </div>
                                        </div>
                                        @if(is_default_lang())
                                            <div class="form-group">
                                                <label class="">{{__("Choose Shipping method")}}</label>
                                                <div class="form-controls">
                                                    <select class="form-control" name="method_id">
                                                        <option value="flat_rate">{{ __("Flat rate") }}</option>
                                                        <option value="free_shipping">{{ __("Free shipping") }}</option>
                                                        <option value="local_pickup">{{ __("Local pickup") }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" data-condition="method_id:is(flat_rate)">
                                                <label class="">{{__("Tax status")}}</label>
                                                <div class="form-controls">
                                                    <select class="form-control" name="method_flat_rate_cost">
                                                        <option value="taxable">{{ __("Taxable") }}</option>
                                                        <option value="none">{{ __("None") }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group" data-condition="method_id:is(flat_rate)">
                                                <label class="">{{__("Cost")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="method_flat_rate_cost" value="0">
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
                        <input type="hidden" name="zone_method_id" value="{{ $zone_method_id ?? '' }}" />
                        <button class="btn btn-primary" type="submit">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
