<div class="form-group">
    <label>{{__("External Url")}}</label>
    <div class="controls">
        <input type="text" value="{{old('external_url',$row->external_url)}}" name="external_url" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{__("Button Text")}}</label>
    <div class="control">
        <input type="text" value="{{old('button_text',$row->button_text ? $row->button_text : __("Buy now"))}}" name="button_text" class="form-control">
    </div>
</div>
