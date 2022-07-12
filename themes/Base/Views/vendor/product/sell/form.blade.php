<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Title")}} </label>
    <div class="controls">
        <input type="text" readonly value="{{$row->title}}" placeholder="{{__("SKU")}}" class="form-control">
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("SKU")}} </label>
    <div class="controls">
        <input type="text" readonly value="{{$row->sku}}" placeholder="{{__("SKU")}}" class="form-control">
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Price")}} <span class="text-danger">*</span></label>
    <div class="controls">
        <input type="number" minlength="1" step="any"  required value="{{old('price',$product_vendor->price)}}" name="price" class="form-control">
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__('Stock quantity')}} <span class="text-danger">*</span></label>
    <div class="controls">
        <input type="number" required min="0" step="1" class="form-control" value="{{old('quantity',$product_vendor->quantity)}}" name="quantity">
    </div>
</div>
