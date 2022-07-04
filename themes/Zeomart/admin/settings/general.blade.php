<div class="row mb-3">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Header Settings')}}</h3>
        <p class="form-group-desc">{{__('Change your options')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label>{{__("Logo Text")}}</label>
                        <div class="form-controls form-group-image">
                            <input type="text" name="zeomart_logo_text" class="form-control" value="{{setting_item('zeomart_logo_text')}}">

                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Logo")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('zeomart_logo',setting_item('zeomart_logo') ?? '') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Header Style")}}</label>
                        <div class="form-controls">
                            <select name="zeomart_header_style" class="form-control">
                                <option @if("1" == (setting_item('zeomart_header_style') ?? '') ) selected @endif value="1">{{__("Style 1")}}</option>
                            </select>
                        </div>
                    </div>
                @endif
                    <div class="form-group">
                        <label>{{__("Topbar Text Left")}}</label>
                        <div class="form-controls">
                            <div id="zeomart_topbar_text_left" class="ace-editor" style="height: 200px" data-theme="textmate" data-mod="html">{{setting_item_with_lang('zeomart_topbar_text_left',request()->query('lang'))}}</div>
                            <textarea class="d-none" name="zeomart_topbar_text_left" > {{ setting_item_with_lang('zeomart_topbar_text_left',request()->query('lang')) }} </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Topbar Text Right")}}</label>
                        <div class="form-controls">
                            <div id="zeomart_topbar_text_right" class="ace-editor" style="height: 200px" data-theme="textmate" data-mod="html">{{setting_item_with_lang('zeomart_topbar_text_right',request()->query('lang'))}}</div>
                            <textarea class="d-none" name="zeomart_topbar_text_right" > {{ setting_item_with_lang('zeomart_topbar_text_right',request()->query('lang')) }} </textarea>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@push('script.body')
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
@endpush
