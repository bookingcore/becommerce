@if(is_default_lang())
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Downloadable Options")}}</h3>
        <p class="form-group-desc">{{__('Config downloadable functions')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label >{{__("Disable downloadable feature?")}}</label>
                    <label ><input type="checkbox" name="product_disable_downloadable" value="1" @if(setting_item('product_disable_downloadable')) checked @endif> {{__('Yes, please disable it')}}</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
