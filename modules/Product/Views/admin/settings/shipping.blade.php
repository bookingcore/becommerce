@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Shipping Zones")}}</h3>
            <p class="form-group-desc">{{__('Shipping Zones')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="mb-3">
                        <a href="#" class="btn btn-sm btn-default">{{ __("Add shipping zone") }}</a>
                    </div>
                    <div class="table-responsive">
                        @php
                        $shippingZones = \Modules\Product\Models\ShippingZone::all();
                        @endphp
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __("Zone name") }} </th>
                                <th>{{ __("Region(s)") }} </th>
                                <th>{{ __("Shipping method(s)") }} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($shippingZones->count() > 0)

                            @else
                                <tr>
                                    <td colspan="3" class="text-center">
                                        {{ __("No shipping zone") }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Shipping Options")}}</h3>
            <p class="form-group-desc">{{__('Shipping Options')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Enable the shipping calculator on the cart page")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="shipping_enable_calc" value="1" @if(!empty($settings['shipping_enable_calc'])) checked @endif /> {{__("Yes")}} </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="" >{{__("Hide shipping costs until an address is entered")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="shipping_cost_requires_address" value="1" @if(!empty($settings['shipping_cost_requires_address'])) checked @endif /> {{__("Yes")}} </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
