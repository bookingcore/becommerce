<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Email Settings")}}</h3>
        <p class="form-group-desc">{{__('Email notifications sent from your site are listed below. Click on an email to configure it')}}</p>
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

            </div>
        </div>
    </div>
</div>
