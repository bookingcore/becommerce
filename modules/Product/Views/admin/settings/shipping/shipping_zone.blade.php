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
            <div class="col-md-12 mb-3">
                <a href="/admin/module/core/settings/index/shipping" class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i> {{ __("Shipping Zones") }}</a>
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
                                        @if(is_default_lang())
                                            <div class="form-group">
                                                <label class="">{{__("Zone name")}} <span class="text-danger">*</span></label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" required name="name" value="{{ $row->name ?? old('name') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="">{{__("Zone regions")}}</label>
                                                <div class="form-controls">
                                                    @php
                                                        if(!empty($row->locations)){
                                                            foreach ($row->locations as $key => $loc){
                                                                $old_regions[] = [$loc->location_code, get_country_name($loc->location_code)];
                                                            }
                                                        }
                                                        \App\Helpers\AdminForm::select2('zone_regions[]',
                                                        ['configs' => [
                                                            'data' => get_country_lists_select2(),
                                                            'allowClear'  => true,
                                                            'placeholder' => __('-- Select regions --')
                                                        ]], $old_regions ?? false, true)
                                                    @endphp
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="">{{__("Order No.")}}</label>
                                                <div class="form-controls">
                                                    <input type="number" class="form-control" name="order" value="{{ $row->order ?? old('order', 1) }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">{{__("Shipping Method")}}</label>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>{{ __("Title") }}</th>
                                                            <th>{{ __("Description") }}</th>
                                                            <th>{{ __("Enable") }}</th>
                                                            <th></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-center" colspan="4">
                                                                {{ __("No shipping methods") }}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="">
                                                    <a href=" " class="btn btn-default">{{ __("Add shipping method") }}</a>
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
                        <input type="hidden" name="zone_id" value="{{ $zone_id ?? '' }}" />
                        <button class="btn btn-primary" type="submit">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
