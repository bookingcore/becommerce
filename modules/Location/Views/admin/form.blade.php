<div class="form-group">
    <label>{{__("Name")}} <span class="text-danger">*</span></label>
    <input type="text" required value="{{old('name',$translation->name)}}" placeholder="{{__("Location name")}}" name="name" class="form-control">
</div>
@if(is_default_lang())
<div class="form-group">
    <label>{{__("Location Address")}} <span class="text-danger">*</span></label>
    <input type="text" required value="{{old('address',$row->address)}}" placeholder="{{__("Location address")}}" name="address" class="form-control">
</div>
<div class="form-group form-index-hide">
    <label class="control-label">{{__("Location Map")}}</label>
    <div class="control-map-group">
        <div id="map_content"></div>
        <div class="g-control @if(!empty($hide_map_detail)) d-none @endif position-absolute top-0 right-0" style="width:250px" >
            <div class="form-group">
                <label>{{__("Map Lat")}}:</label>
                <input type="text" name="map_lat" class="form-control" value="{{$row->map_lat}}">
            </div>
            <div class="form-group">
                <label>{{__("Map Lng")}}:</label>
                <input type="text" name="map_lng" class="form-control" value="{{$row->map_lng}}">
            </div>
            <div class="form-group">
                <label>{{__("Map Zoom")}}:</label>
                <input type="text" name="map_zoom" class="form-control" value="{{$row->map_zoom ?? "8"}}">
            </div>
        </div>
    </div>
    <p><i>{{__('Click onto map to place Location address')}}</i></p>
</div>
@endif
