@if(is_default_lang())
    <div class="form-group">
        <label class="control-label">{{__("Price")}}</label>
        <input type="number" step="any" min="0" name="price" class="form-control" value="{{$row->price}}" placeholder="{{__("Price")}}">
    </div>
    <div class="form-group">
        <label class="control-label">{{__("Sale Price")}}</label>
        <input type="number" step="any" name="sale_price" class="form-control" value="{{$row->sale_price}}" placeholder="{{__("Sale Price")}}">
        <span><i>{{__("If the regular price is less than the discount , it will show the regular price")}}</i></span>
    </div>
@endif