@if(is_default_lang())
    <div class="form-group">
        <label class="control-label">{{__("Price")}}</label>
        <div class="controls">
            <input type="number" step="any" min="0" name="price" class="form-control" value="{{$row->price}}" placeholder="{{__("Price")}}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">{{__("Origin Price (Optional)")}}</label>
        <div class="controls">
            <input type="number" step="any" name="origin_price" class="form-control" value="{{$row->origin_price}}" placeholder="{{__("Origin Price")}}">
            <span><i>{{__("Must be great than price")}}</i></span>
        </div>
    </div>
@endif
