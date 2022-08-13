<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("General Style")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('General Options')}}</strong></div>
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Enable Back to Top")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" @if(setting_item('demus_enable_scroll') ?? '' == 1) checked @endif name="demus_enable_scroll" value="1">{{__('Enable')}}</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Enable Header Scroll")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" @if(setting_item('demus_enable_header_scroll') ?? '' == 1) checked @endif name="demus_enable_header_scroll" value="1">{{__('Enable')}}</label>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

