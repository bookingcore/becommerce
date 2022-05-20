@if(!empty($compare))
    <thead>
        <tr class="remove">
            <td></td>
            @foreach ($compare as $row)
                <td class="text-center">
                    <a href="{{$row['detail_url']}}">{{ e($row['title']) }}</a>
                    <a href="#" class="axtronic-remove-compare" data-id="{{ $row['id'] }}">
                        <span>{{ __('Remove') }}</span>
                    </a>
                </td>
            @endforeach
        </tr>
    </thead>
    <tbody class="text-center">

        <tr class="image">
            <td>{{ __("Image") }}</td>
            @foreach ($compare as $row)
                <td>
                    @if(!empty($img = get_file_url($row['image_id'])))
                        <img src="{{ $img }}" alt="{{$row['title']}}">
                    @endif
                </td>
            @endforeach
        </tr>

        <tr class="price">
            <td>{{ __("Price") }}</td>
            @foreach ($compare as $row)
                <td>
                    {!! $row['price_html'] !!}
                </td>
            @endforeach
        </tr>
        <tr class="add-to-cart">
            <td></td>
            @foreach ($compare as $row)
                <td><a href="{{$row['detail_url']}}">{{ __("View Detail") }}</a></td>
            @endforeach
        </tr>
        <tr class="description">
            <td>{{ __('Description') }}</td>
            @foreach ($compare as $row)
                <td class="text-start">{!! clean($row['short_desc']) !!}</td>
            @endforeach
        </tr>
        <tr class="stock">
            <td>{{ __('Availability') }}</td>
            @foreach ($compare as $row)
                <td class="text-center"> {{ ($row['stock_status'] == 'in' ? __('In stock') : __('Out of stock')) }} </td>
            @endforeach
        </tr>
        <tr class="stock">
            <td>{{ __('Brand') }}</td>
            @foreach ($compare as $row)
                <td class="text-center"> {{ e($row['brand_name'] ?? "") }} </td>
            @endforeach
        </tr>
        <tr>
            <td>
                {{ __("Variations") }}
            </td>
            @foreach ($compare as $row)
                @if(!empty($row['attrs']))
                    <td>
                        @foreach( $row['attrs'] as $item)
                            <p class="mb-0">
                                {{ implode(", ",$item) }}
                            </p>
                        @endforeach
                    </td>
                @else
                    <td></td>
                @endif
            @endforeach
        </tr>

    </tbody>
@else
    {{ __('No products added in the compare table') }}
@endif
