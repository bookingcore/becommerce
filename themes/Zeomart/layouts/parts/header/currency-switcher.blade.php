@php
    $actives = \App\Currency::getActiveCurrency();
    $current = \App\Currency::getCurrent('currency_main');

@endphp
@if(!empty($actives) and count($actives) > 1)

    <li class="list-inline-item">
        <div class="htcw_form_select">
            <span class="stts">{{ __("Currency") }}</span>
            <select class="bc-currency-sw">
                @foreach($actives as $currency)
                    @if($current != $currency['currency_main'])
                        <option value="{{get_currency_switcher_url($currency['currency_main'])}}">
                            {{strtoupper($currency['currency_main'])}}
                        </option>
                    @endif
                @endforeach
            </select>


        </div>
        <div class="zm-dropdown">
            <button class="zm-dropdown-toggle" type="button">Dropdown</button>
            <div class="zm-dropdown-menu">
                <a href="#">Đường Dẫn 1</a>
                <a href="#">Đường Dẫn 2</a>
                <a href="#">Đường Dẫn 3</a>
            </div>
        </div>
    </li>
@endif
