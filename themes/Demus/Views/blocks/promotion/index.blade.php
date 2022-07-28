{{--Demus promotions--}}
<section class="demus-promotions">
    <div class="container">
        @if(!empty($title))
            <div class="box-heading-title text-center mb-xl-3 pb-4">
                <h2 class="heading-title ">{!! clean($title) !!}</h2>
                <p class="sub-heading">{!! clean($sub_title) !!}</p>
            </div>
        @endif
        <div class="row mt-4">
            @foreach($list_items as $key => $item)
                @php
                    switch ($col){
                        case '4': $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4 style-$col"; break;
                        case '3': $colClass = "col-xl-$col col-lg-$col col-md-6 col-sm-12 col-12 mb-lg-0 mb-4 style-$col"; break;
                        default: $colClass = "col-xl-$col col-lg-$col col-md-$col col-sm-12 col-12 mb-lg-0 mb-4 style-$col";
                    }
                @endphp
                <div class="{{ $colClass }} mb-xl-0 mb-4 ">
                    <div class="promotions-item {{ $item['style_color'] ?? ''}}">
                        <div class="item-bg" style="background-image: url({{ get_file_url($item['image'] ?? '' , "full") }});"></div>
                        <div class="item-content {{ $item['position'] }} {{ !empty($slide['is_dark']) ? 'light' : 'dark' }} ">
                            <span class="sub-title">
                                <svg class="me-2" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.23404 10.7912L6.06842 12.9566C4.67996 14.3456 2.43069 14.3463 1.04154 12.9566C-0.347491 11.5681 -0.348174 9.31887 1.04154 7.92973L3.2069 5.7641C3.23851 5.73249 3.27071 5.70147 3.30347 5.67105C3.50992 5.47951 3.84474 5.61625 3.85604 5.89762C3.86131 6.02906 3.87239 6.16031 3.88929 6.29093C3.90244 6.39257 3.86889 6.49456 3.7964 6.567C3.34577 7.01732 1.74174 8.62128 1.73742 8.6256C0.732861 9.63073 0.733052 11.2557 1.73742 12.2607C2.74254 13.2652 4.36756 13.265 5.37249 12.2607L7.53812 10.0951L7.54796 10.0852C8.54057 9.08246 8.53617 7.45829 7.53785 6.45997C7.31324 6.23537 7.05722 6.0613 6.78357 5.93746C6.65872 5.88097 6.58051 5.75516 6.5885 5.61836C6.59674 5.4766 6.6227 5.33643 6.66577 5.20112C6.72328 5.02063 6.92638 4.92875 7.10106 5.00206C7.51321 5.17498 7.89914 5.42917 8.23404 5.76407C9.62004 7.1501 9.6198 9.40544 8.23404 10.7912ZM5.76501 8.23313C6.09992 8.56804 6.48585 8.82223 6.898 8.99515C7.07267 9.06843 7.27578 8.97655 7.33329 8.79609C7.37636 8.66078 7.40232 8.52061 7.41056 8.37885C7.41854 8.24205 7.34031 8.11624 7.21549 8.05975C6.94183 7.93593 6.68581 7.76186 6.46121 7.53723C5.46289 6.53891 5.45849 4.91475 6.4511 3.912L6.46094 3.90216L8.62656 1.73653C9.6315 0.732169 11.2565 0.731977 12.2616 1.73653C13.266 2.74147 13.2662 4.36648 12.2616 5.37161C12.2573 5.3759 10.6533 6.97989 10.2027 7.43021C10.1302 7.50267 10.0966 7.60464 10.1098 7.70627C10.1267 7.83682 10.1377 7.96806 10.143 8.09959C10.1543 8.38098 10.4892 8.5177 10.6956 8.32616C10.7284 8.29574 10.7606 8.26472 10.7922 8.23311L12.9575 6.06748C14.3472 4.67834 14.3465 2.42907 12.9575 1.04061C11.5684 -0.349113 9.3191 -0.348429 7.93064 1.04061L5.76501 3.20596C4.37926 4.59179 4.37901 6.84713 5.76501 8.23313Z" fill="#161311"></path></svg>
                                {{ $item['title'] ?? '' }}
                            </span>
                            <h3 class="title">{{ $item['title'] ?? '' }}</h3>
                            <p>
                                {!! $item['content'] ?? '' !!}
                            </p>
                            <a href="{{ $item['link'] ?? '' }}" class="btn-link-outline ">{{ __('Shop Now') }} </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

