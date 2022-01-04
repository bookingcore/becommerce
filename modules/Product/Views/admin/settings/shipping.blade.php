@if(is_default_lang())
    <div class="row">
        <div class="col-sm-12">
            <h3 class="form-group-title">{{__("Shipping Zones")}}</h3>
            <div class="panel">
                <div class="panel-body">
                    <div class="mb-3">
                        <a href="{{ route('product.shipping.new') }}" class="btn btn-sm btn-default">{{ __("Add shipping zone") }}</a>
                    </div>
                    <div class="table-responsive">
                        @php
                        $shippingZones = \Modules\Product\Models\ShippingZone::all();
                        @endphp
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __("Zone name") }}</th>
                                <th>{{ __("Region(s)") }}</th>
                                <th>{{ __("Shipping method(s)") }}</th>
                                <th>{{ __("Order") }}</th>
                                <th class="text-center" style="width: 90px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($shippingZones->count() > 0)
                                @foreach($shippingZones as $shippingZone)
                                    <tr>
                                        <td><a href="{{ route('product.shipping.edit', ['id' => $shippingZone->id]) }}">{{ $shippingZone->name }}</a></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href=""  class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
                                            <a href="{{ route('product.shipping.edit', ['id' => $shippingZone->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">
                                        {{ __("No shipping zone") }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td><a href="#">{{ __("Locations not covered by your other zones") }}</a></td>
                                <td>{{ __("This zone is optionally used for regions that are not included in any other shipping zone.") }}</td>
                                <td>{{ __("No shipping methods") }}</td>
                                <td></td>
                                <td><a href="{{ route('product.shipping.edit', ['id' => 'other']) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a></td>
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
        <div class="col-sm-12">
            <h3 class="form-group-title">{{__("Shipping Options")}}</h3>
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Enable the shipping calculator on the cart page")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="shipping_enable_calc" value="1" @if(!empty($settings['shipping_enable_calc'])) checked @endif /> {{__("On")}} </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="" >{{__("Hide shipping costs until an address is entered")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="shipping_cost_requires_address" value="1" @if(!empty($settings['shipping_cost_requires_address'])) checked @endif /> {{__("On")}} </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
