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
                        <label>{{__("Gallery Style")}}</label>
                        <div class="form-controls form-group-image">
                            <select name="freshen_product_gallery"  class="form-control">
                                <option value="">{{__("Thumb bottom")}}</option>
                                <option @if(setting_item('freshen_product_gallery') == 'thumb_left') selected @endif value="thumb_left">{{__("Thumb left")}}</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
