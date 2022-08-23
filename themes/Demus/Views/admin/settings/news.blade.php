<?php
use Modules\Product\Models\ProductAttr;

?>

<div class="row mb-3">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('News Page Settings')}}</h3>
        <p class="form-group-desc">{{__('Change your options')}}</p>
    </div>

    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                @if(is_default_lang())
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>{{__("Search page layout")}}</label>
                            <div class="form-controls">
                                <select name="demus_news_layout" class="form-control">
                                    <option @if(setting_item('demus_news_layout')== 'left-sidebar') selected @endif value="left-sidebar">{{__('Left Sidebar')}}</option>
                                    <option @if(setting_item('demus_news_layout')== 'right-sidebar') selected @endif value="right-sidebar">{{__('Right Sidebar')}}</option>
                                    <option @if(setting_item('demus_news_layout')== 'no-sidebar') selected @endif value="no-sidebar">{{__('No Sidebar')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label mb-2">{{__("Number of columns displayed")}}</label>
                        <div class="form-controls">
                            <select name="demus_news_item_layout" class="form-control">
                                <option @if(setting_item('demus_news_item_layout')==1) selected @endif value="1">{{__('Column 1')}}</option>
                                <option @if(setting_item('demus_news_item_layout')==2) selected @endif value="2">{{__('Column 2')}}</option>
                                <option @if(setting_item('demus_news_item_layout')==3) selected @endif value="3">{{__('Column 3')}}</option>
                                <option @if(setting_item('demus_news_item_layout')==4) selected @endif value="4">{{__('Column 4')}}</option>
                                <option @if(setting_item('demus_news_item_layout')==6) selected @endif value="6">{{__('Column 6')}}</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

