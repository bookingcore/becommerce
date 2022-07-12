<div class="card section-shipping-form">
    <div class="card-header font-weight-bold">{{__('Calculate shipping')}}</div>
    <div class="card-body">
        @php
            $shipping_session = \Modules\Order\Helpers\CartManager::getShipping();
            $list_country = get_country_lists();
        @endphp
        @if(!empty($shipping_session['method_selected']))
            <div class="method">
                @php
                    $list_method = \Modules\Order\Helpers\CartManager::getMethodShipping($shipping_session['shipping_country']);
                @endphp
                @foreach($list_method as $key => $item)
                    @php $translate = $item->translate(); @endphp
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="method_id" id="method_id_{{$key}}" @if($shipping_session['method_selected'] == $item['method_id']) checked @endif value="{{ $item['method_id'] }}">
                        <label class="form-check-label" for="method_id_{{$key}}">
                            {{ $translate->title }} {{ !empty($item->cost) ? format_money($item->cost) : "" }}
                        </label>
                    </div>
                @endforeach
                <div class="text">
                    {{ __('Shipping to :city :address.',['address'=>$list_country[$shipping_session['shipping_country']],'city'=>$shipping_session['shipping_city'] ? $shipping_session['shipping_city']."," : ""]) }}
                </div>
                <div class="text text-end" >
                    <a data-bs-toggle="collapse" href="#collapse_shipping_form">
                        {{ __("Change address") }}
                    </a>
                </div>
            </div>
        @elseif(!empty( $shipping_session['shipping_country'] ))
            <div class="text">
                {{ __('No shipping options were found for :city :address.',['address'=>$list_country[$shipping_session['shipping_country']],'city'=>$shipping_session['shipping_city'] ? $shipping_session['shipping_city']."," : ""]) }}
            </div>
            <div class="text text-end" >
                <a data-bs-toggle="collapse" href="#collapse_shipping_form">
                    {{ __("Change address") }}
                </a>
            </div>
        @endif
        <div class="collapse @if(empty($shipping_session['shipping_country'])) show @endif" id="collapse_shipping_form">
            <div class="form-group mb-3 mt-4" >
                <select class="form-control" name="shipping_country">
                    @foreach($list_country as $key => $val)
                        <option value="{{ $key }}" @if(!empty($shipping_session['shipping_country']) and $shipping_session['shipping_country'] == $key )selected @endif >{{$val}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <input class="form-control" type="text" name="shipping_city" value="{{ !empty($shipping_session['shipping_city']) ? $shipping_session['shipping_city']:  "" }}" placeholder="{{ __("Town/City") }}">
            </div>
            <div class="form-group mb-3">
                <input class="form-control" type="text" name="shipping_zip" value="{{ !empty($shipping_session['shipping_zip']) ? $shipping_session['shipping_zip']:  ""  }}" placeholder="{{ __("Postcode/Zip") }}">
            </div>
            <div class="form-group text-end">
                <button class="btn btn-primary axtronic_calculate_shipping">
                    {{__('Update')}}
                    <i class="fa fa-spin fa-spinner d-none"></i>
                </button>
            </div>
        </div>

    </div>
</div>
