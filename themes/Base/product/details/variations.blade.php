@if(!empty($product_variations))
    @php
        $list_variations = [];
        $list_attributes = [];
        foreach($product_variations as  $variation){
            if(empty($variation->isActive())) continue;
            $term_ids = $variation->term_ids;
            $list_variations[$variation->id] = ['variation_id'=>$variation->id,'variation'=>$variation->getAttributesForDetail()];
            foreach($row->attributes_for_variation_data as $item){
                foreach($item['terms'] as $term){
                    if(in_array($term->id,$term_ids)){
                        $list_variations[$variation->id]['terms'][] = ["id"=>$term->id,"title"=> $term->name];
                        $list_attributes[ $item['attr']->name ][$term->id] = [
                            'name'=>$term->name,
                            'color'=>$term->content,
                            'image'=>"",
                            'type'=>$item['attr']->display_type,
                        ];
                    }
                }
            }
        }
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
                            <div class="item mr-2 me-2 border rounded border-dark">
                                <input class="d-none item-attribute" type="radio" id="attribute_{{$id}}" name="attribute_{{$name}}" value="{{$id}}">
                                @switch($value['type'])
                                    @case("color")
                                        <label style="background-color: {{$value['color']}};" class="miw-30px mih-30px d-flex align-items-center pe-2 ps-2 justify-content-center" for="attribute_{{$id}}">
                                        </label>
                                    @break
                                    @default
                                        <label class="miw-30px mih-30px d-flex align-items-center pe-2 ps-2 justify-content-center" for="attribute_{{$id}}">
                                            {{$value['name']}}
                                        </label>
                                @endswitch
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
        <div class="mb-2">
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
