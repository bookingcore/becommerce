@php
    $actives = \App\Currency::getActiveCurrency();
    $current = \App\Currency::getCurrent('currency_main');
@endphp
@if(!empty($actives) and count($actives) > 1)
    <li class="dropdown">
        <a href="#" class="nav-link text-white" data-bs-toggle="dropdown">
            @foreach($actives as $currency)
                @if($current == $currency['currency_main'])
                    {{strtoupper($currency['currency_main'])}}
                @endif
            @endforeach
        </a>
        <ul class="dropdown-menu text-left">
            @foreach($actives as $currency)
                @if($current != $currency['currency_main'])
                    <li>
                        <a href="{{get_currency_switcher_url($currency['currency_main'])}}">
                            {{strtoupper($currency['currency_main'])}}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@endif
