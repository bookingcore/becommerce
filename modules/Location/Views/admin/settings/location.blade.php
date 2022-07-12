<div class="row">
    <div class="col-sm-3">
        <h3 class="form-group-title">{{__("Location Options")}}</h3>
    </div>
    <div class="col-md-9">
        <div class="panel">
            <div class="panel-title"><strong>{{__("General Options")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Show Location Selection in header")}}</label>
                    <div class="form-controls">
                        <select name="location_in_header" class="form-select form-control">
                            <option value="">{{__("No, hide it please")}}</option>
                            <option @if(setting_item('location_in_header')) selected @endif value="1">{{__("Yes, please")}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Default Location")}}</label>
                    <div class="form-controls">
                        <select name="location_default" class="form-select form-control">
                            <option value="">{{__("-- Please Select --")}}</option>
                            @foreach(\Modules\Location\Models\Location::query()->get() as $location)
                                <option @if(setting_item('location_default') == $location->id) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Customer Location Detect")}}</label>
                    <div class="form-controls">
                        <select name="location_detect" class="form-select form-control">
                            <option value="geoip">{{__("Geoip")}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="panel">
            <div class="panel-title"><strong>{{__("Inventory")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Turn on Inventory per location?")}}</label>
                    <div class="form-controls">
                        <label >
                            <input type="checkbox" value="1" @if(setting_item('location_inventory_enable')) checked @endif class="form-control" name="location_inventory_enable" /> {{__("Yes, please")}}
                        </label>
                        <p><i>{{__("* You will be able to input stock value for every location")}}</i></p>
                        <p><i>{{__("* Make sure you enable Stock Management in Product setting:")}}</i>. <a
                                href="{{route('core.admin.setting',['group'=>'product'])}}">{{__("->Check product setting")}}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
