<?php
if($row->product_type != 'variable') return;
$old = old('variations',[]);
?>
<div class="panel">
    <div class="panel-title"><strong>{{__("Variations")}}</strong></div>
    <div class="panel-body">
        <table class="table bc-table">
            <thead>
                <tr>
                    <th>{{__("Variation")}}</th>
                    <th>{{__("Price")}}</th>
                    <th>{{__("Quantity")}}</th>
                    <th>{{__("Image")}}</th>
                    <th>{{__("Active?")}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($row->variations as $variation)
                <?php
                $vendor_variation = \Modules\Product\Models\Vendor\ProductVendorVariation::firstOrNew([
                   'vendor_id'=>auth()->id(),
                   'parent_id'=>$variation->id
                ]);
                ?>
                <tr>
                    <td>
                        @if($terms = $variation->terms())
                            <div class="mb-2">
                                @foreach($terms as $term)
                                    <div><strong>{{$term->attribute->name}}:</strong> {{$term->name}}</div>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="controls">
                                <input type="number" min="0" class="form-control" value="{{$vendor_variation->price}}" name="variations[{{$variation->id}}][price]">
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group" >
                            <div class="controls">
                                <input type="number" min="0" class="form-control" value="{{$vendor_variation->quantity}}" name="variations[{{$variation->id}}][quantity]">
                            </div>
                        </div>
                    </td>
                    <td>
                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('variations['.$variation->id.'][image_id]',$vendor_variation->image_id) !!}
                    </td>
                    <td>
                        <div class="form-group align-items-center">
                            <div class="controls">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50 mr-2" value="1" @if($vendor_variation->active) checked @endif name="variations[{{$variation->id}}][active]"> {{__("Yes, please")}}
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
