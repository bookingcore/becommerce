@if(!empty($row->variations))
    @if(!empty($attrs_list))
        <table class="variations">
            <tbody>
                @foreach($attrs_list as $item)
                    <tr>
                        <td class="label">
                            <label for="pa_color">
                                {{ $item['attr']['name'] }}:<span class="mf-attr-value" data-attr_id="{{ $item['attr']['id'] }}" data-term="0" data-default="{{ __('Choose An Option') }}">{{ __('Choose An Option') }}</span>
                            </label>
                        </td>
                        <td class="value">
                            <div class="tawcvs-swatches" data-attribute_name="attribute_pa_color">
                                @foreach($item['terms'] as $term)
                                    @if($item['attr']['type'] == 'image')
                                        <span class="swatch swatch-image square" data-toggle="tooltip" data-get_term="{{ $term['term_id'] }}" data-name="{{ $term['name'] }}" title="{{ $term['name'] }}">
                                            {!! get_image_tag($term['content'],'thumb',['lazy'=>false]) !!}
                                        </span>
                                    @elseif($item['attr']['type'] == 'color')
                                        <span class="swatch swatch-color round" style="background: {{ $term['content'] }}" data-name="{{ $term['name'] }}" data-toggle="tooltip" data-get_term="{{ $term['term_id'] }}" title="{{ $term['name'] }}"></span>
                                    @else
                                        <span class="swatch swatch-label square" data-toggle="tooltip" data-get_term="{{ $term['term_id'] }}" data-name="{{ $term['name'] }}" title="{{ $term['name'] }}">{{ $term['content'] }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="single_variation_wrap">
            <div class="single_variation">
                <div class="variation-price"></div>
                <div class="variation-stock">{{ __('Status:') }} <span class="stock-status"></span></div>
            </div>
        </div>
    @endif

    <div class="product-detail-variable">
        @foreach($row->variations as $item=>$value)
            <span class="item-variable" data-price="{{$value->price}}" data-sku="{{$value->sku}}">{{$value->sku}}</span>
        @endforeach
        <div class="product-detail-variable-description">
            <p class="price">
                <span class="amount"></span>
            </p>
        </div>
    </div>
@endif
