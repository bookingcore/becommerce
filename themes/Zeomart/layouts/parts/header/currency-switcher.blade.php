@php
    $actives = \App\Currency::getActiveCurrency();
    $current = \App\Currency::getCurrent('currency_main');
@endphp
@if(!empty($actives) and count($actives) > 1)
    <div class="bc-currency-sw zm-dropdown relative">
        <button class="zm-dropdown-toggle" type="button">
            @foreach($actives as $currency)
                @if($current == $currency['currency_main'])
                    {{strtoupper($currency['currency_main'])}}
                @endif
            @endforeach
            <svg class="inline" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5.07671 5.3393L8.86404 1.5519C8.9517 1.4643 9 1.34736 9 1.22268C9 1.09799 8.9517 0.981058 8.86404 0.89346L8.58519 0.614544C8.40349 0.433052 8.10818 0.433052 7.92675 0.614544L4.74638 3.79492L1.56248 0.611015C1.47482 0.523417 1.35795 0.475052 1.23333 0.475052C1.10858 0.475052 0.991712 0.523417 0.903975 0.611015L0.625198 0.889931C0.537531 0.977598 0.489235 1.09446 0.489235 1.21915C0.489235 1.34383 0.537531 1.46077 0.625198 1.54837L4.41599 5.3393C4.50393 5.4271 4.62135 5.47533 4.74617 5.47505C4.87148 5.47533 4.98883 5.4271 5.07671 5.3393Z" fill="#041E42"/>
            </svg>
        </button>
        <div class="zm-dropdown-menu hidden absolute top-full left-0 w-40 bg-slate-100 box-border p-2  pl-3 pr-3 rounded mt-2">
            @foreach($actives as $currency)
                @if($current != $currency['currency_main'])
                    <div class="item">
                        <a href="{{get_currency_switcher_url($currency['currency_main'])}}">
                            {{strtoupper($currency['currency_main'])}}
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endif