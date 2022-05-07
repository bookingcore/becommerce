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
                        <label>{{__("Logo Light")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('axtronic_logo_light',setting_item('axtronic_logo_light') ?? '') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Logo Dark")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('axtronic_logo_dark',setting_item('axtronic_logo_dark') ?? '') !!}
                        </div>
                    </div>
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

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Footer Settings')}}</h3>
        <p class="form-group-desc">{{__('Change your options')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <label for="axtronic_hotline_text" class="">{{__("Hotline Text")}}</label>
                        <div class="form-controls">
                            <input type="text" id="axtronic_hotline_text" class="form-control" name="axtronic_hotline_text" value="{{setting_item('axtronic_hotline_text')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="axtronic_hotline_contact" class="">{{__("Hotline")}}</label>
                        <div class="form-controls">
                            <input type="text" id="axtronic_hotline_contact" class="form-control" name="axtronic_hotline_contact" value="{{setting_item('axtronic_hotline_contact')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="axtronic_email_contact" class="">{{__("Email Contact")}}</label>
                        <div class="form-controls">
                            <input type="text" id="axtronic_email_contact" class="form-control" name="axtronic_email_contact" value="{{setting_item('axtronic_email_contact')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="axtronic_footer_style">{{__("Footer Style")}}</label>
                        <div class="form-controls">
                            <select id="axtronic_footer_style" name="axtronic_footer_style" class="form-control">
                                <option @if("1" == (setting_item('axtronic_footer_style') ?? '') ) selected @endif value="1">{{__("Style 1")}}</option>
                                <option @if("2" == (setting_item('axtronic_footer_style') ?? '') ) selected @endif value="2">{{__("Style 2")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Footer Text Subscribe")}}</label>
                        <div class="form-controls">
                            <div id="info_text_editor_1" class="ace-editor" style="height: 200px" data-theme="textmate" data-mod="html">{{setting_item_with_lang('axtronic_footer_text_subscribe')}}</div>
                            <textarea class="d-none" name="axtronic_footer_text_subscribe" > {{ setting_item_with_lang('axtronic_footer_text_subscribe') }} </textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Footer Background Image Subscribe")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('axtronic_footer_bg_image',setting_item('axtronic_footer_bg_image') ?? '') !!}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label>{{__("Footer List Widget")}}</label>
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="form-group-item">
                                <div class="g-items-header">
                                    <div class="row">
                                        <div class="col-md-3">{{__("Title")}}</div>
                                        <div class="col-md-2">{{__('Size')}}</div>
                                        <div class="col-md-6">{{__('Content')}}</div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="g-items">
                                    <?php
                                    $social_share = setting_item_with_lang('axtronic_list_widget_footer',request()->query('lang'));
                                    if(!empty($social_share)) $social_share = json_decode($social_share,true);
                                    if(empty($social_share) or !is_array($social_share))
                                        $social_share = [];
                                    ?>
                                    @foreach($social_share as $key=>$item)
                                        <div class="item" data-number="{{$key}}">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <input type="text" name="axtronic_list_widget_footer[{{$key}}][title]" class="form-control" value="{{$item['title']}}">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="axtronic_list_widget_footer[{{$key}}][size]">
                                                        <option @if(!empty($item['size']) && $item['size']=='2') selected @endif value="2">1/6</option>
                                                        <option @if(!empty($item['size']) && $item['size']=='3') selected @endif value="3">1/4</option>
                                                        <option @if(!empty($item['size']) && $item['size']=='4') selected @endif value="4">1/3</option>
                                                        <option @if(!empty($item['size']) && $item['size']=='6') selected @endif value="6">1/2</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea name="axtronic_list_widget_footer[{{$key}}][content]" rows="5" class="form-control">{{$item['content']}}</textarea>
                                                </div>
                                                <div class="col-md-1">
                                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="text-right">
                                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                                </div>
                                <div class="g-more hide">
                                    <div class="item" data-number="__number__">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" __name__="axtronic_list_widget_footer[__number__][title]" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <select class="form-control" __name__="axtronic_list_widget_footer[__number__][size]">
                                                    <option value="3">1/4</option>
                                                    <option value="4">1/3</option>
                                                    <option value="6">1/2</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <textarea __name__="axtronic_list_widget_footer[__number__][content]" class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Footer Contact")}}</label>
                    <div class="form-controls">
                        <div id="info_text_editor" class="ace-editor" style="height: 200px" data-theme="textmate" data-mod="html">{{setting_item_with_lang('axtronic_footer_info_text',request()->query('lang'))}}</div>
                        <textarea class="d-none" name="axtronic_footer_info_text" > {{ setting_item_with_lang('axtronic_footer_info_text',request()->query('lang')) }} </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Copyright")}}</label>
                    <div class="form-controls">
                        <input name="axtronic_copyright" class="form-control" value="{{setting_item_with_lang('axtronic_copyright',request()->query('lang')) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Footer Text Right")}}</label>
                    <div class="form-controls">
                        <textarea name="axtronic_footer_text_right" class="d-none has-tinymce" cols="30" rows="10">{{setting_item_with_lang('axtronic_footer_text_right',request()->query('lang')) }}</textarea>
                    </div>
                </div>
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
