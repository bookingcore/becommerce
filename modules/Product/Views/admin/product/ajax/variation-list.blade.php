@foreach($product->variations as  $variation)
    <div class="variation-item">
        <div class="variation-header">
            <span class="variation-id"><strong>#{{$variation->id}}</strong>:</span>
            @foreach($product->attributes_for_variation_data as $item)
                <div class="attr-item">{{$item['attr']->name}}:
                    <select class="form-control">
                        @foreach($item['terms'] as $term)
                            <option value="{{$term->id}}" @if(in_array($term->id,$variation->term_ids)) selected @endif >{{$term->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <button class="btn btn-sm" data-toggle="collapse" data-target="#variation-{{$variation->id}}"><i class="fa fa-chevron-down"></i></button>
        </div>
        <div class="variation-body" id="variation-{{$variation->id}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__('Enabled?')}}</label>
                        <div class="controls">
                            <input type="checkbox" value="1" @if($variation->active) checked @endif name="variations[{{$variation->id}}][active]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__('SKU')}}</label>
                        <div class="controls">
                            <input type="text" class="form-group" value="{{$variation->sku}}" name="variations[{{$variation->id}}][sku]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__('Price')}}</label>
                        <div class="controls">
                            <input type="number" min="0" class="form-group" value="{{$variation->price}}" name="variations[{{$variation->id}}][[price]">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{__('Manage Stock?')}}</label>
                        <div class="controls">
                            <input type="checkbox" value="1" @if($variation->is_manage_stock) checked @endif name="variations[{{$variation->id}}][[is_manage_stock]">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" v-condition="is_manage_stock:is(1)">
                    <div class="form-group">
                        <label class="control-label">{{__('Stock quantity')}}</label>
                        <div class="controls">
                            <input type="number" min="0" class="form-group" value="{{$variation->quantity}}" name="variations[{{$variation->id}}][[quantity]">
                        </div>
                    </div>
                </div>
                <div class="col-md-6" v-condition="is_manage_stock:is(0)">
                    <div class="form-group">
                        <label class="control-label">{{__('Stock status')}}</label>
                        <div class="controls">
                            <select name="variations[{{$variation->id}}][[stock_status]" class="form-control">
                                <option value="in">{{__("In stock")}}</option>
                                <option value="out">{{__("Out stock")}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach