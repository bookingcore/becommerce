<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Header & Footer Settings')}}</h3>
        <p class="form-group-desc">{{__('Change your options')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label class="">{{__("Hotline")}}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="freshen_hotline_contact" value="{{setting_item('freshen_hotline_contact')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{__("Email Contact")}}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="freshen_email_contact" value="{{setting_item('freshen_email_contact')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Footer Style")}}</label>
                        <div class="form-controls">
                            <select name="freshen_footer_style" class="form-control">
                                <option @if("1" == (setting_item('freshen_footer_style') ?? '') ) selected @endif value="1">{{__("Style 1")}}</option>
                                <option @if("2" == (setting_item('freshen_footer_style') ?? '') ) selected @endif value="2">{{__("Style 2")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Footer Background Image")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('freshen_footer_bg_image',setting_item('freshen_footer_bg_image') ?? '') !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>