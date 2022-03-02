@if(is_default_lang())
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__('SKU')}}</label>
    <div class="controls">
        <input type="text" class="form-control" value="{{$product->sku}}" name="sku">
    </div>
</div>
<div class="form-group mb-3 align-items-center" data-condition="product_type:is(simple)">
    <label class="control-label mb-2">{{__('Manage Stock?')}}</label>
    <div class="controls">
        <label >
            <input data-name="is_manage_stock" type="checkbox" value="1" @if($product->is_manage_stock) checked @endif name="is_manage_stock"> {{__('Enable stock management at product level')}}
        </label>
    </div>
</div>

<div class="form-group mb-3" data-condition="is_manage_stock:is(),product_type:is(simple)">
    <label class="control-label mb-2">{{__('Stock status')}}</label>
    <div class="controls">
        <select name="stock_status" class="form-control">
            <option value="in">{{__("In stock")}}</option>
            <option @if($product->stock_status == 'out') selected @endif value="out">{{__("Out of stock")}}</option>
        </select>
    </div>
</div>

<div class="form-group mb-3" data-condition="is_manage_stock:is(1),product_type:is(simple)">
    <label class="control-label mb-2">{{__('Stock quantity')}}</label>
    <div class="controls">
        <input type="number" min="0" class="form-control" value="{{$product->quantity}}" name="quantity">
    </div>
</div>
@endif
