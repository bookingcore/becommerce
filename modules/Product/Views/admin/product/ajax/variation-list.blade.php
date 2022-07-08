@foreach($product->variations as  $variation)
    <div class="variation-item border @if(!empty($tailwind)) mb-4 @endif">
        <div class="variation-header bg-slate-200 d-flex justify-content-between flex justify-between items-center px-3 py-2 cursor-pointer" data-target="#variation-{{$variation->id}}" >
            <div class="d-flex align-items-center flex items-center">
                <span class="variation-id mr-2"><strong>#{{$variation->id}}</strong>:</span>
                @foreach($product->attributes_for_variation_data as $item)
                    <div class="attr-item d-flex align-items-center flex items-center mr-4">
                        <span class="flex-shink-0 shrink-0 mr-2">{{$item['attr']->name}}: </span>
                        <select name="variations[{{$variation->id}}][terms][]" class="form-control @if(!empty($tailwind)) pt-1 pb-1 @endif">
                            @foreach($item['terms'] as $term)
                                <option value="{{$term->id}}" @if(in_array($term->id,$variation->term_ids)) selected @endif >{{$term->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endforeach
            </div>
            <div>
                <span class="btn btn-danger btn-sm btn-delete-variation" data-id="{{$variation->id}}" data-toggle="tooltip" title="{{__("Delete variation")}}"><i class="fa fa-trash"></i> </span>
            </div>
        </div>
        <div class="variation-body collapse hidden @if(!empty($tailwind)) p-3 @endif" id="variation-{{$variation->id}}">
            <div class="variation-body-inner">
                <input type="hidden" name="variations[{{$variation->id}}][id]" value="{{$variation->id}}">
                <div class="row grid gap-4 grid-cols-12">
                    <div class="col-md-8 col-span-8">
                        <div class="form-group mb-3 align-items-center">
                            <label class="control-label mb-2">{{__('Enabled?')}}</label>
                            <div class="controls">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 mr-2" value="1" @if($variation->active) checked @endif name="variations[{{$variation->id}}][active]"> {{__("Yes, I want to enable it")}}
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
                        @if(setting_item('product_enable_stock_management'))
                            <div class="form-group mb-3 align-items-center">
                                <label class="control-label mb-2">{{__('Manage Stock?')}}</label>
                                <div class="controls">
                                    <label >
                                        <input data-name="is_manage_stock" type="checkbox" value="1" @if($variation->is_manage_stock) checked @endif name="variations[{{$variation->id}}][is_manage_stock]"> {{__('Yes, please')}}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-3" v-condition="is_manage_stock:is(1)">
                                <label class="control-label mb-2">{{__('Stock quantity')}}</label>
                                <div class="controls">
                                    <input type="number" min="0" class="form-control" value="{{$variation->quantity}}" name="variations[{{$variation->id}}][quantity]">
                                </div>
                            </div>
                        @endif
                        <div class="form-group mb-3" v-condition="is_manage_stock:is()">
                            <label class="control-label mb-2">{{__('Stock status')}}</label>
                            <div class="controls">
                                <select name="variations[{{$variation->id}}][stock_status]" class="form-control form-select">
                                    <option value="in">{{__("In stock")}}</option>
                                    <option @if($variation->stock_status == 'out') selected @endif value="out">{{__("Out of stock")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-span-4">
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('variations['.$variation->id.'][image_id]',$variation->image_id) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
