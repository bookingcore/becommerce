@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Product Options")}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Product must be approved by admin")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="vendor_product_need_approve" value="1" @if(setting_item('vendor_product_need_approve')) checked @endif /> {{__("Yes please")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("ON: When vendor posts a service, it needs to be approved by administrator")}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
