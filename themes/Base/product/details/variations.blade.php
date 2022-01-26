@if(!empty($product_variations))
    <div class="bc-product-variations mb-2">
        <div class="mb-1">{{ __('Select: ') }}</div>
        <div class="row">
            @php $list = []; @endphp
            @php $list2 = []; @endphp
            @foreach($product_variations as  $variation)
                @php $term_ids = $variation->term_ids ;
                    $list[$variation->id] = ['variation_id'=>$variation->id];
                @endphp
                <div class="col-lg-6">
                    <div class="variation mb-2">
                        <input id="variation-{{ $variation->id }}" type="radio" name="variation" value="{{ $variation->id }}">
                        <label for="variation-{{ $variation->id }}">
                            @foreach($row->attributes_for_variation_data as $item)
                                @foreach($item['terms'] as $term)
                                    @if(in_array($term->id,$term_ids))
                                        {{$item['attr']->name}}: {{$term->name}}<span>,</span>

                                        @php
                                            $list2[ $item['attr']->name ][$term->id] = $term->name;
                                            $list[$variation->id]['terms'][] = ["id"=>$term->id,"title"=> $term->name]
                                        @endphp

                                    @endif
                                @endforeach
                            @endforeach
                        </label>
                    </div>
                </div>
            @endforeach
            @php dump($list2) @endphp
            @php dump($list) @endphp
        </div>
    </div>
    <div class='bc_variations' data-variations="{{ json_encode($list) }}"></div>
    <input type="hidden" name="variation_id" class="variation_id" value="19">

    <div class="bc-product-variations mb-2">
        @if(!empty($list2))
            @foreach($list2 as $name=>$values)
                <div class="variation d-flex mb-3">
                    <div class="name me-3 f-w-10">{{ $name }}: </div>
                    <div class="values d-flex flex-wrap">
                        @foreach($values as $id => $value )
                            <div class="item mr-2">
                                <input class="d-nonex item-attribute" type="radio" id="attribute_{{$id}}" name="attribute_{{$name}}" value="{{$id}}">
                                <label class="miw-30px mih-30px border rounded d-flex align-items-center pe-2 ps-2 me-2 justify-content-center" for="attribute_{{$id}}">
                                    {{$value}}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endif
