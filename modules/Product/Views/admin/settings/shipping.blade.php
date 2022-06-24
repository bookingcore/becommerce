@if(is_default_lang())
    <div class="row">
        <div class="col-sm-12">
            <h3 class="form-group-title">{{__("Shipping Zones")}}</h3>
            <div class="panel">
                <div class="panel-body">
                    <div class="mb-3">
                        <a href="{{ route('product.shipping.create') }}" class="btn btn-sm btn-default">{{ __("Add shipping zone") }}</a>
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
                                        <td>
                                            @if($shippingZone->locations)
                                                @foreach($shippingZone->locations as $key => $location)
                                                    {{ $key == 0 ? $location->location_code : ', ' . $location->location_code }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if($shippingZone->shippingMethods)
                                                @foreach($shippingZone->shippingMethods as $key => $shippingMethod)
                                                    @if($shippingMethod->is_enabled == 1)
                                                        {{ $shippingMethod->title }},
                                                    @else
                                                        <span style="text-decoration: line-through">{{ $shippingMethod->title }}</span>,
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            {{ !empty($shippingZone->order) ? $shippingZone->order : 0 }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                                    {{__("Actions")}}
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a href="{{ route('product.shipping.edit', ['id' => $shippingZone->id]) }}" class="dropdown-item"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                                    <a href="{{ route('product.shipping.delete', ['id' => $shippingZone->id]) }}" data-confirm="{{__("Do you want to delete?")}}" class="dropdown-item bc-delete-item" ><i class="fa fa-times"></i> {{__('Delete')}}</a>
                                                </div>
                                            </div>
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
                            @php
                                $default_zone_methods = \Modules\Product\Models\ShippingZoneMethod::query()
                                    ->whereNull('zone_id')
                                    ->get();
                            @endphp
                            <tfoot>
                            <tr>
                                <td>
                                    <a href="{{ route('product.shipping.edit', ['id' => 'other']) }}">
                                        {{ __("Locations not covered by your other zones") }}
                                    </a>
                                </td>
                                <td>{{ __("This zone is optionally used for regions that are not included in any other shipping zone.") }}</td>
                                <td>
                                    @if($default_zone_methods)
                                        @foreach($default_zone_methods as $key => $shippingMethod)
                                            @if($shippingMethod->is_enabled == 1)
                                                {{ $shippingMethod->title }},
                                            @else
                                                <span style="text-decoration: line-through">{{ $shippingMethod->title }}</span>,
                                            @endif
                                        @endforeach
                                    @else
                                        {{ __("No shipping methods") }}
                                    @endif
                                </td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                                            {{__("Actions")}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{ route('product.shipping.edit', ['id' => 'other']) }}" class="dropdown-item"><i class="fa fa-edit"></i> {{__('Edit')}}</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row d-none">
        <div class="col-sm-12">
            <h3 class="form-group-title">{{__("Shipping Options")}}</h3>
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Enable the shipping calculator on the cart page")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="shipping_enable_calc" value="1" checked/> {{__("On")}} </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
