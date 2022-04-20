@if(!empty($data_variations = $row->variationMappingResource()))
    @php
        $list_variations = $data_variations["variations"];
        $list_attributes = $data_variations['attributes'];
    @endphp
    <div class="bc-product-variations mb-2">
        <input type="hidden" class="bc_variations" value="{{ json_encode($list_variations) }}">
        <input type="hidden" name="variation_id" class="variation_id" value="">
        @if(!empty($list_attributes))
            @foreach($list_attributes as $name=>$values)
                <div class="variation d-flex mb-3">
                    <div class="name me-3 f-w-10">{{ $name }}: </div>
                    <div class="values d-flex flex-wrap">
                        @foreach($values as $id => $value )
                            <div class="item mr-2 me-2 border border-dark">
                                <input class="d-none item-attribute" type="radio" id="attribute_{{$id}}" name="attribute_{{$name}}" value="{{$id}}">
                                @switch($value['type'])
                                    @case("color")
                                        <label style="background-color: {{$value['color']}};" class="d-flex align-items-center pe-2 ps-2 justify-content-center" for="attribute_{{$id}}">
                                        </label>
                                    @break
                                    @default
                                        <label class="d-flex align-items-center pe-2 ps-2 justify-content-center" for="attribute_{{$id}}">
                                            {{$value['name']}}
                                        </label>
                                @endswitch
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
        <div class="mb-3">
            <p class="mb-0 quantity d-none">
                <span class="value"></span>
                {{__("in stock")}}
            </p>
            <p class="mb-0 price d-none">
                {{__("Price: ")}}
                <span class="value"></span>
            </p>
            <p class="mb-0 sku d-none">
                {{__("SKU: ")}}
                <span class="value"></span>
            </p>
        </div>
    </div>
@endif
