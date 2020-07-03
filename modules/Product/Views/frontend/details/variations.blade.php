@if(!empty($row->variations))
    @if(!empty($listAttrs))
        <table class="variations" cellspacing="0">
            <tbody>
            @foreach($listAttrs as $attr)
                <tr>
                    @if(!empty($variable))
                        <td class="label">
                            <label for="pa_color">
                                {{ $attr->name }}:<span class="mf-attr-value" data-attr_id="{{$attr->id}}" data-term="0" data-default="{{ __('Choose An Option') }}">{{ __('Choose An Option') }}</span>
                            </label>
                        </td>
                        <td class="value">
                            <div class="tawcvs-swatches" data-attribute_name="attribute_pa_color">
                                @php $attrs_list = [] @endphp
                                @foreach($variable as $item)
                                    @if($attr->id == $item->attr_id)
                                        @php
                                            $item_content = [
                                                'term_id'=>$item->term_id,
                                                'name'=>$item->name,
                                                'content'=>$item->content,
                                                'type'=>$item->display_type,
                                            ];
                                            array_push($attrs_list, $item_content);
                                        @endphp
                                    @endif
                                @endforeach

                                @php $get_attrs = array_unique($attrs_list, SORT_REGULAR) @endphp
                                @if($get_attrs)
                                    @foreach($get_attrs as $item)
                                        @if($item['type'] == 'image')
                                            <span class="swatch swatch-image square" data-toggle="tooltip" data-get_term="{{ $item['term_id'] }}" data-name="{{ $item['name'] }}" title="{{ $item['name'] }}">
                                                {!! get_image_tag($item['content'],'thumb',['lazy'=>false]) !!}
                                            </span>
                                        @elseif($item['type'] == 'color')
                                            <span class="swatch swatch-color round" style="background: {{ $item['content'] }}" data-name="{{ $item['name'] }}" data-toggle="tooltip" data-get_term="{{ $item['term_id'] }}" title="{{ $item['name'] }}"></span>
                                        @else
                                            <span class="swatch swatch-label square" data-toggle="tooltip" data-get_term="{{ $item['term_id'] }}" data-name="{{ $item['name'] }}" title="{{ $item['name'] }}">{{ $item['content'] }}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </td>
                    @endif

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
