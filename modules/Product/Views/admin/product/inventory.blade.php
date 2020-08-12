<div class="form-group">
    <label class="control-label">{{__('SKU')}}</label>
    <div class="controls">
        <input type="text" class="form-control" value="{{$product->sku}}" name="sku">
    </div>
</div>
<div class="form-group align-items-center">
    <label class="control-label">{{__('Manage Stock?')}}</label>
    <div class="controls">
        <label >
            <input data-name="is_manage_stock" type="checkbox" value="1" @if($product->is_manage_stock) checked @endif name="is_manage_stock"> {{__('Enable stock management at product level')}}
        </label>
    </div>
</div>

<div class="form-group" data-condition="is_manage_stock:is()">
    <label class="control-label">{{__('Stock status')}}</label>
    <div class="controls">
        <select name="stock_status" class="form-control">
            <option value="in">{{__("In stock")}}</option>
            <option @if($product->stock_status == 'out') selected @endif value="out">{{__("Out of stock")}}</option>
        </select>
    </div>
</div>

<div class="form-group" data-condition="is_manage_stock:is(1)">
    <label class="control-label">{{__('Stock quantity')}}</label>
    <div class="controls">
        <input type="number" min="0" class="form-control" value="{{$product->quantity}}" name="quantity">
    </div>
</div>