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
                            <?php
                            $country = false;
                            \App\Helpers\AdminForm::select2('store_country', [
                                'configs' => [

                                ]
                            ])
                            ?>
                        </div>
                        <input type="text" class="form-control" name="store_country" value="{{setting_item_with_lang('store_country',request()->query('lang'))}}">
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
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Product Settings")}}</h3>
        <p class="form-group-desc">{{__('Settings for product')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Shipping Settings")}}</h3>
        <p class="form-group-desc">{{__('Shipping Settings')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Email Settings")}}</h3>
        <p class="form-group-desc">{{__('Email Settings')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Tax Settings")}}</h3>
        <p class="form-group-desc">{{__('Tax Settings')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>

@section('script.body')
    <script src="{{asset('libs/ace/src-min-noconflict/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        (function ($) {
            $('.ace-editor').each(function () {
                var editor = ace.edit($(this).attr('id'));
                editor.setTheme("ace/theme/"+$(this).data('theme'));
                editor.session.setMode("ace/mode/"+$(this).data('mod'));
                var me = $(this);

                editor.session.on('change', function(delta) {
                    // delta.start, delta.end, delta.lines, delta.action
                    me.next('textarea').val(editor.getValue());
                });
            });
        })(jQuery)
    </script>
@endsection
