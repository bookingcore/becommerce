<div class="row mb-3">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Product Settings')}}</h3>
        <p class="form-group-desc">{{__('Change your options')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label for="header_contact">{{__("Header Contact  ")}}</label>
                        <div class="form-controls">
                            <div class="form-controls">
                                <input type="text" id="header_contact" class="form-control" name="axtronic_header_contact" value="{{setting_item('axtronic_header_contact')}}">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
