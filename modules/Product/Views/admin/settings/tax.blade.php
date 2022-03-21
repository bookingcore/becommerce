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
                        <label class="" >{{__("Calculate tax based on")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="tax_based_on">
                                <option value="shipping" @if(@setting_item('tax_based_on') == 'shipping') selected @endif >{{ __("Customer shipping address") }}</option>
                                <option value="billing" @if(@setting_item('tax_based_on') == 'billing') selected @endif >{{ __("Customer billing address") }}</option>
                               {{-- <option value="shop_base" @if(@setting_item('tax_based_on') == 'shop_base') selected @endif >{{ __("Shop base address") }}</option>--}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Prices entered with tax")}}</label>
                        <div class="form-controls">
                            <select class="form-control" name="prices_include_tax">
                                <option value="yes" @if(@setting_item('prices_include_tax') == 'yes') selected @endif >{{ __("Yes, I will enter prices inclusive of tax") }}</option>
                                <option value="no" @if(@setting_item('prices_include_tax') == 'no') selected @endif >{{ __("No, I will enter prices exclusive of tax") }}</option>
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
                                        <td>{{ $taxRate->country }}</td>
                                        <td>{{ $taxRate->state }}</td>
                                        <td>{{ $taxRate->postcode ?? '' }}</td>
                                        <td>{{ $taxRate->city ?? '' }}</td>
                                        <td>{{ $taxRate->tax_rate }}</td>
                                        <td>{{ $transition->name }}</td>
                                        <td>{{ $taxRate->priority }}</td>
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
