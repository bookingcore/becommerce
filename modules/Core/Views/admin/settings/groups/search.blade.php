<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Advance Search Engine Configs")}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__('Driver Config')}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label>{{__("Search Engine Provider")}}</label>
                    <div class="form-controls">
                        <select name="search_driver" class="form-control" >
                            <option value="" >{{__("-- Please select --")}}</option>
                            <option value="algolia" @if(setting_item('search_driver') == 'algolia') selected @endif>{{__('Algolia')}}</option>
                        </select>
                    </div>
                </div>
                <div  data-condition="search_driver:is(algolia)">
                    <div class="form-group">
                        <label>{{__("Algolia APP ID")}}</label>
                        <div class="form-controls">
                            <input type="text" name="algolia_app_id" value="{{setting_item('algolia_app_id')}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Algolia SECRET")}}</label>
                        <div class="form-controls">
                            <input type="text" name="algolia_secret" value="{{setting_item('algolia_secret')}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Algolia Public")}}</label>
                        <div class="form-controls">
                            <input type="text" name="algolia_public" value="{{setting_item('algolia_public')}}" class="form-control">
                        </div>
                    </div>
                    <p><i>{{__('If you have old data, you can sync it with algolia here:')}}</i> <a href="{{\Illuminate\Support\Facades\URL::signedRoute('core.admin.search.sync',['driver'=>'algolia'])}}" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> {{__("Sync Old Data")}}</a></p>

                </div>
            </div>
        </div>
    </div>
</div>
