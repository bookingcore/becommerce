<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Store Settings")}}</h3>
        <p class="form-group-desc">{{__('Setting for your store')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Address")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="store_address" value="{{setting_item_with_lang('store_address',request()->query('lang'))}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("City")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="store_city" value="{{setting_item_with_lang('store_city',request()->query('lang'))}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Country")}}</label>
                    <div class="form-controls">
                        <div class="form-controls">
                            <select name="store_country" class="form-control">
                                <option value="">{{__('-- Select --')}}</option>
                                @foreach(get_country_lists() as $id => $name)
                                    <option @if(setting_item_with_lang('store_country',request()->query('lang')) ==$id) selected @endif value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Postcode / ZIP")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="store_postcode" value="{{setting_item_with_lang('store_postcode',request()->query('lang'))}}">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
