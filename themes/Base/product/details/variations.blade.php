@if(!empty($product_variations))
    <div class="bc-product-variations mb-2">
        <div class="mb-1">{{ __('Select: ') }}</div>
        <div class="row">
            @foreach($product_variations as  $variation)
                @php $term_ids = $variation->term_ids @endphp
                <div class="col-lg-6">
                    <div class="variation mb-2">
                        <input id="variation-{{ $variation->id }}" type="radio" name="variation" value="{{ $variation->id }}">
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

    <div class="bc-product-variations mb-2">
        <div class="variation d-flex mb-3">
            <div class="name me-3 f-w-10">Color: </div>
            <div class="values d-flex flex-wrap">
                <div class="item mr-2">
                    <input class="d-none" type="radio" id="html" name="fav_language" value="HTML">
                    <label style="background: blue" class="miw-30px mih-30px border rounded d-flex align-items-center pe-2 ps-2 me-2 justify-content-center" for="html"></label>
                </div>
                <div class="item mr-2">
                    <input class="d-none" type="radio" id="html2" name="fav_language" value="HTML2">
                    <label style="background: red" class="miw-30px mih-30px border rounded d-flex align-items-center pe-2 ps-2 me-2 justify-content-center" for="html2"></label>
                </div>
                <div class="item mr-2">
                    <input class="d-none" type="radio" id="html2" name="fav_language" value="HTML2">
                    <label style="background: orange" class="miw-30px mih-30px border rounded d-flex align-items-center pe-2 ps-2 me-2 justify-content-center" for="html2"></label>
                </div>
            </div>
        </div>
        <div class="variation d-flex mb-3">
            <div class="name me-3 f-w-10">Size: </div>
            <div class="values d-flex flex-wrap">
                <div class="item mr-2">
                    <input class="d-none" type="radio" id="html" name="fav_language" value="HTML">
                    <label class="miw-30px mih-30px border rounded d-flex align-items-center pe-2 ps-2 me-2 justify-content-center" for="html">S</label>
                </div>
                <div class="item mr-2">
                    <input class="d-none" type="radio" id="html2" name="fav_language" value="HTML2">
                    <label class="miw-30px mih-30px border rounded d-flex align-items-center pe-2 ps-2 me-2 justify-content-center" for="html2">L</label>
                </div>
            </div>
        </div>
    </div>
@endif
