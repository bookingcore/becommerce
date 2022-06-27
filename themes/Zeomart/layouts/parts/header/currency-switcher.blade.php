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
        <div class="zm-dropdown relative">
            <button class="zm-dropdown-toggle" type="button">Dropdown</button>
            <div class="zm-dropdown-menu hidden absolute top-full left-0">
                <div class="item">
                    <a href="#">Menu 1</a>
                </div>
                <div class="item">
                    <a href="#">Menu 2</a>
                </div>
            </div>
        </div>
    </li>
@endif
