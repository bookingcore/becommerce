@if(!empty($product_variations))
    <div class="bc-product-variations mb-2">
        <div class="mb-1">{{ __('Select: ') }}</div>
        <div class="row">
            @foreach($product_variations as  $variation)
                @php $term_ids = $variation->term_ids @endphp
                <div class="col-lg-6">
                    <div class="variation mb-2">
                        <input id="variation-{{ $variation->id }}" type="radio" name="variant_id" value="{{ $variation->id }}">
                        <label for="variation-{{ $variation->id }}">
                            @foreach($row->attributes_for_variation_data as $item)
                                @foreach($item['terms'] as $term)
                                    @if(in_array($term->id,$term_ids))
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
