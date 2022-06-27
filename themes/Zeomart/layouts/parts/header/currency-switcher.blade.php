@php
    $actives = \App\Currency::getActiveCurrency();
    $current = \App\Currency::getCurrent('currency_main');

@endphp
@if(!empty($actives) and count($actives) > 1)

    <li class="list-inline-item">
        <div class="htcw_form_select">
            <span class="stts">{{ __("Currency") }}</span>
            <select class="custom_select_dd bc-currency-sw" id="selectbox_currency">
                @foreach($actives as $currency)
                    @if($current != $currency['currency_main'])
                        <option value="{{get_currency_switcher_url($currency['currency_main'])}}">
                            {{strtoupper($currency['currency_main'])}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
@endif
