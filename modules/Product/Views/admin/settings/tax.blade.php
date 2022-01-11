<div class="row">
    <div class="col-sm-12">
        <h3 class="form-group-title">{{__("Tax Settings")}}</h3>
    </div>
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label class="" >{{__("Enable tax rates and calculations")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="tax_enable_calc" value="1" @if(!empty(setting_item('tax_enable_calc'))) checked @endif /> {{__("On")}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Prices entered with tax")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="tax_prices_include_tax">
                                <option value="yes" @if(@setting_item('tax_prices_include_tax') == 'yes') selected @endif >{{ __("Yes, I will enter prices inclusive of tax") }}</option>
                                <option value="no" @if(@setting_item('tax_prices_include_tax') == 'no') selected @endif >{{ __("No, I will enter prices exclusive of tax") }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Shipping tax class")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="tax_shipping_tax_class">
                                <option value="inherit" @if(@setting_item('tax_shipping_tax_class') == 'inherit') selected @endif >{{ __("Shipping tax class based on cart items") }}</option>
                                <option value="standard" @if(@setting_item('tax_shipping_tax_class') == 'standard') selected @endif >{{ __("Standard") }}</option>
                                <option value="reduced_rate" @if(@setting_item('tax_shipping_tax_class') == 'reduced_rate') selected @endif >{{ __("Reduced rate") }}</option>
                                <option value="zero_rate" @if(@setting_item('tax_shipping_tax_class') == 'zero_rate') selected @endif >{{ __("Zero rate") }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Rounding")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="tax_round_at_subtotal" value="1" @if(!empty(setting_item('tax_round_at_subtotal'))) checked @endif /> {{__("Round tax at subtotal level, instead of rounding per line")}} </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Additional tax classes")}}</label>
                        <div class="form-controls">
                            <textarea class="form-control" name="tax_classes">{!! @setting_item('tax_classes') !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Display prices in the shop")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="tax_display_shop">
                                <option value="include" @if(@setting_item('tax_display_shop') == 'include') selected @endif >{{ __("Including tax") }}</option>
                                <option value="exclude" @if(@setting_item('tax_display_shop') == 'exclude') selected @endif >{{ __("Excluding tax") }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Display prices during cart and checkout")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="tax_display_cart">
                                <option value="include" @if(@setting_item('tax_display_cart') == 'include') selected @endif >{{ __("Including tax") }}</option>
                                <option value="exclude" @if(@setting_item('tax_display_cart') == 'exclude') selected @endif >{{ __("Excluding tax") }}</option>
                            </select>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="" >{{__("Price display suffix")}}</label>
                    <div class="form-controls">
                        <input type="text" name="tax_price_display_suffix" class="form-control" value="{{ @setting_item_with_lang('tax_price_display_suffix', request()->query('lang'), '') }}" placeholder="{{ __("N/A") }}">
                    </div>
                </div>
                @if(is_default_lang())
                    <div class="form-group">
                        <label class="" >{{__("Display tax totals")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="tax_total_display">
                                <option value="single" @if(@setting_item('tax_total_display') == 'single') selected @endif >{{ __("As a single total") }}</option>
                                <option value="itemized" @if(@setting_item('tax_total_display') == 'itemized') selected @endif >{{ __("Itemized") }}</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<hr>
<div class="row">
    <div class="col-sm-12">
        <h3 class="form-group-title">{{__("Tax rate classes")}}</h3>
    </div>
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-body">
                <div class="mb-3">
                    <a href="{{ route('product.tax.create') }}" class="btn btn-sm btn-default">{{ __("Add item") }}</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __("Country code") }}</th>
                            <th>{{ __("State code") }}</th>
                            <th>{{ __("Postcode / ZIP") }}</th>
                            <th>{{ __("City") }}</th>
                            <th>{{ __("Rate %") }}</th>
                            <th>{{ __("Tax name") }}</th>
                            <th>{{ __("Priority") }}</th>
                            <th>{{ __("Compound") }}</th>
                            <th>{{ __("Shipping") }}</th>
                            <th>{{ __("Class") }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        @php
                            $taxRates = \Modules\Product\Models\TaxRate::all();
                        @endphp
                        <tbody>
                            @if($taxRates && $taxRates->count() > 0)
                                @foreach($taxRates as $key => $taxRate)
                                    @php $transition = $taxRate->translate(request()->query('lang')) @endphp
                                    <tr>
                                        <td>{{ $taxRate->country_code }}</td>
                                        <td>{{ $taxRate->state }}</td>
                                        <td>{{ $taxRate->locationPostcodes->location_code ?? '' }}</td>
                                        <td>{{ $taxRate->locationCities->location_code ?? '' }}</td>
                                        <td>{{ $taxRate->tax_rate }}</td>
                                        <td>{{ $transition->name }}</td>
                                        <td>{{ $taxRate->priority }}</td>
                                        <td><input type="checkbox" @if(!empty($taxRate->compound)) checked @endif disabled class="disabled" /></td>
                                        <td><input type="checkbox" @if(!empty($taxRate->shipping)) checked @endif disabled class="disabled" /></td>
                                        <td>{{ $taxRate->class_name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                    {{__("Actions")}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('product.tax.edit', ['id' => $taxRate->id]) }}" class="dropdown-item"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                                    <a href="{{ route('product.tax.delete', ['id' => $taxRate->id]) }}" data-confirm="{{__("Do you want to delete?")}}" class="dropdown-item bc-delete-item" ><i class="fa fa-times"></i> {{__('Delete')}}</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="11">{{ __("No tax rates") }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
