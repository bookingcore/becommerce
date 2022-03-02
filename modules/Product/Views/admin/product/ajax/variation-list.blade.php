@foreach($product->variations as  $variation)
    <div class="variation-item">
        <div class="variation-header d-flex justify-content-between" data-target="#variation-{{$variation->id}}" >
            <div class="d-flex align-items-center">
                <span class="variation-id"><strong>#{{$variation->id}}</strong>:</span>
                @foreach($product->attributes_for_variation_data as $item)
                    <div class="attr-item d-flex align-items-center">
                        <span class="flex-shink-0">{{$item['attr']->name}}: </span>
                        <select name="variations[{{$variation->id}}][terms][]" class="form-control">
                            @foreach($item['terms'] as $term)
                                <option value="{{$term->id}}" @if(in_array($term->id,$variation->term_ids)) selected @endif >{{$term->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
            <div>
                <span class="btn btn-warning btn-sm btn-delete-variation" data-id="{{$variation->id}}" data-toggle="tooltip" title="{{__("Delete variation")}}"><i class="fa fa-trash"></i> </span>
            </div>
        </div>
        <div class="variation-body collapse" id="variation-{{$variation->id}}">
            <div class="variation-body-inner">
                <input type="hidden" name="variations[{{$variation->id}}][id]" value="{{$variation->id}}">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3 align-items-center">
                            <label class="control-label mb-2">{{__('Enabled?')}}</label>
                            <div class="controls">
                                <label >
                                    <input type="checkbox" value="1" @if($variation->active) checked @endif name="variations[{{$variation->id}}][active]"> {{__("Yes, I want to enable it")}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label mb-2">{{__('SKU')}}</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="{{$variation->sku}}" name="variations[{{$variation->id}}][sku]">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="control-label mb-2">{{__('Price')}}</label>
                            <div class="controls">
                                <input type="number" min="0" class="form-control" value="{{$variation->price}}" name="variations[{{$variation->id}}][price]">
                            </div>
                        </div>
                        <div class="form-group mb-3 align-items-center">
                            <label class="control-label mb-2">{{__('Manage Stock?')}}</label>
                            <div class="controls">
                                <label >
                                    <input data-name="is_manage_stock" type="checkbox" value="1" @if($variation->is_manage_stock) checked @endif name="variations[{{$variation->id}}][is_manage_stock]"> {{__('Yes, please')}}
                                </label>
                            </div>
                        </div>

                        <div class="form-group mb-3" v-condition="is_manage_stock:is()">
                            <label class="control-label mb-2">{{__('Stock status')}}</label>
                            <div class="controls">
                                <select name="variations[{{$variation->id}}][stock_status]" class="form-control form-select">
                                    <option value="in">{{__("In stock")}}</option>
                                    <option @if($variation->stock_status == 'out') selected @endif value="out">{{__("Out of stock")}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3" v-condition="is_manage_stock:is(1)">
                            <label class="control-label mb-2">{{__('Stock quantity')}}</label>
                            <div class="controls">
                                <input type="number" min="0" class="form-control" value="{{$variation->quantity}}" name="variations[{{$variation->id}}][quantity]">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('variations['.$variation->id.'][image_id]',$variation->image_id) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
