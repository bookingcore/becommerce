<tbody class="text-center">
@if(!empty($compare))
    <tr class="remove">
        <th></th>
        @foreach ($compare as $row)
            <td class="text-center">
                <a href="#" class="bc-remove-compare" data-id="{{ $row['id'] }}">
                    <span>{{ __('Remove') }}</span>
                </a>
            </td>
        @endforeach
    </tr>
    <tr class="image">
        <th></th>
        @foreach ($compare as $row)
            <td>
                @if(!empty($img = get_file_url($row['image_id'])))
                    <img src="{{ $img }}" alt="{{$row['title']}}">
                @endif
            </td>
        @endforeach
    </tr>
    <tr class="title">
        <th></th>
        @foreach ($compare as $row)
            <td>
                <a href="{{$row['detail_url']}}">{{ e($row['title']) }}</a>
            </td>
        @endforeach
    </tr>
    <tr class="price">
        <th>{{ __("Price") }}</th>
        @foreach ($compare as $row)
            <td>
                {!! $row['price_html'] !!}
            </td>
        @endforeach
    </tr>
    <tr class="add-to-cart">
        <th></th>
        @foreach ($compare as $row)
            <td><a href="{{$row['detail_url']}}">{{ __("View Detail") }}</a></td>
        @endforeach
    </tr>
    <tr class="description">
        <th>{{ __('Description') }}</th>
        @foreach ($compare as $row)
            <td class="text-start">{!! clean($row['short_desc']) !!}</td>
        @endforeach
    </tr>
    <tr class="stock">
        <th>{{ __('Availability') }}</th>
        @foreach ($compare as $row)
            <td class="text-center"> {{ ($row['stock_status'] == 'in' ? __('In stock') : __('Out of stock')) }} </td>
        @endforeach
    </tr>
    <tr class="stock">
        <th>{{ __('Brand') }}</th>
        @foreach ($compare as $row)
            <td class="text-center"> {{ e($row['brand_name'] ?? "") }} </td>
        @endforeach
    </tr>
    <tr>
        <th>
            {{ __("Variations") }}
        </th>
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
@else
    <tr class="no-products" role="row">
        <td>{{ __('No products added in the compare table') }}</td>
    </tr>
@endif
</tbody>