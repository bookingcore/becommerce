{{--@if(!empty($product_variations))
    <div class="bc-product-variations mb-2">
        <div class="mb-1">{{ __('Select: ') }}</div>
        <div class="row">
            @dd($row->attributes_for_variation_data)
            @foreach( $product_variations as $item)
                @php $variation_terms = $item->variation_terms @endphp
            @dd($variation_terms)
                <div class="col-lg-4">
                    <div class="variation mb-2">
                        <input id="variation-1" type="radio" name="variation" value="1">
                        <label for="variation-1">Blue - M</label>
                    </div>
                </div>

            @endforeach


        </div>
    </div>

@endif--}}
@if(!empty($product_variations))
    <div class="bc-product-variations mb-2">
        <div class="mb-1">{{ __('Select: ') }}</div>
        <div class="row">
            @foreach($product_variations as  $variation)
                @php @endphp
                <div class="col-lg-6">
                    <div class="variation mb-2">
                        <input id="variation-{{ $variation->id }}" type="radio" name="variation" value="{{ $variation->id }}">
                        <label for="variation-{{ $variation->id }}">
                            @foreach($row->attributes_for_variation_data as $item)
                                @foreach($item['terms'] as $term)
                                    @if(in_array($term->id,$variation->term_ids))
                                        {{$item['attr']->name}}: {{$term->name}}<span>,</span>
                                    @endif
                                @endforeach
                            @endforeach
                        </label>
                    </div>
                </div>

            @endforeach


        </div>
    </div>

@endif
