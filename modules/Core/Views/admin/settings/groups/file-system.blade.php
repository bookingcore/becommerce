<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Filesystem Configs")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__('Filesystem Driver')}}</label>
                    <div class="form-controls">
                        <select name="filesystem_default" class="form-control">
                            <option value="uploads" {{setting_item('filesystem_default') == 'uploads' ? 'selected' : ''  }}>{{__('Default')}}</option>
                            <option value="s3" {{setting_item('filesystem_default') == 's3' ? 'selected' : ''  }}>{{__('AWS S3')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel" data-condition="filesystem_default:is(s3)">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Key")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_w3_key" value="{{setting_item('filesystem_w3_key')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Secret access key")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_w3_secret_access_key" value="{{setting_item('filesystem_w3_secret_access_key')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Default region")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_w3_region" value="{{setting_item('filesystem_w3_region')}}" />
                </div>
                <div class="form-group">
                    <label class="">{{__("Bucket")}}</label>
                    <input type="text" class="form-control" autocomplete="none" name="filesystem_w3_bucket" value="{{setting_item('filesystem_w3_bucket')}}" />
                </div>
            </div>
        </div>
    </div>
</div>
