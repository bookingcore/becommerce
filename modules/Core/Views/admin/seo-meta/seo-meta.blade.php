<?php
$meta_seo = $row->getSeoMeta();
$seo_share = $meta_seo['seo_share'] ?? false;
?>
<div class="panel">
    <div class="panel-title"><strong>{{__("Seo Manager")}}</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 @if(!is_default_lang()) d-none @endif ">
                    <label class="control-label mb-2">
                        {{__("Allow search engines to show this service in search results?")}}
                    </label>
                    <select name="seo_index" class="form-control form-select">
                        <option value="1" @if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 1) selected @endif>{{__("Yes")}}</option>
                        <option value="0" @if(isset($meta_seo['seo_index']) and $meta_seo['seo_index'] == 0) selected @endif>{{__("No")}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="@if(!empty($tailwind)) border border-gray-200 rounded @endif" data-condition="seo_index:is(1)">
            <div class="border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="nav nav-tabs flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400" id="seo_meta_nav" data-condition="seo_index:is(1)" data-tabs-toggle="#seo_meta_tab">
                    <li class="nav-item mr-2">
                        <a class="nav-link active inline-flex @if(!empty($tailwind)) p-4 @endif rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group" data-toggle="tab" href="#seo_1" data-tabs-target="#seo_1" role="tab" onclick="return false">{{__("General Options")}}</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link inline-flex @if(!empty($tailwind)) p-4 @endif rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group" data-toggle="tab" href="#seo_2" data-tabs-target="#seo_2" role="tab" onclick="return false">{{__("Share Facebook")}}</a>
                    </li>
                    <li class="nav-item mr-2">
                        <a class="nav-link inline-flex @if(!empty($tailwind)) p-4 @endif rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group" data-toggle="tab" href="#seo_3" data-tabs-target="#seo_3" role="tab" onclick="return false">{{__("Share Twitter")}}</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content p-4"  id="seo_meta_tab">
                <div class="tab-pane active" role="tabpanel" id="seo_1">
                    <div class="form-group mb-3" >
                        <label class="control-label mb-2">{{__("Seo Title")}}</label>
                        <input type="text" name="seo_title" class="form-control" placeholder="{{ $row->title ?? $row->name ?? __("Leave blank to use service title")}}" value="{{ $meta_seo['seo_title'] ?? ""}}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label mb-2">{{__("Seo Description")}}</label>
                        <textarea name="seo_desc" rows="3" class="form-control" placeholder="{{trim(strip_tags($row->short_desc)) ?? __("Enter description...")}}">{{$meta_seo['seo_desc'] ?? ""}}</textarea>
                    </div>
                    @if(is_default_lang())
                        <div class="form-group mb-3 form-group mb-3-image">
                            <label class="control-label mb-2">{{__("Featured Image")}}</label>
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('seo_image', $meta_seo['seo_image'] ?? "" ) !!}
                        </div>
                    @endif
                </div>
                <div class="tab-pane hidden" role="tabpanel" id="seo_2">
                    <div class="form-group mb-3">
                        <label class="control-label mb-2">{{__("Facebook Title")}}</label>
                        <input type="text" name="seo_share[facebook][title]" class="form-control" placeholder="{{ $row->title ?? $row->name ?? __("Enter title...")}}" value="{{$seo_share['facebook']['title'] ?? "" }}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label mb-2">{{__("Facebook Description")}}</label>
                        <textarea name="seo_share[facebook][desc]" rows="3" class="form-control" placeholder="{{trim(strip_tags($row->short_desc)) ?? __("Enter description...")}}">{{$seo_share['facebook']['desc'] ?? "" }}</textarea>
                    </div>
                    @if(is_default_lang())
                        <div class="form-group mb-3 form-group mb-3-image">
                            <label class="control-label mb-2">{{__("Facebook Image")}}</label>
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ) !!}
                        </div>
                    @endif
                </div>
                <div class="tab-pane hidden" role="tabpanel" id="seo_3">
                    <div class="form-group mb-3">
                        <label class="control-label mb-2">{{__("Twitter Title")}}</label>
                        <input type="text" name="seo_share[twitter][title]" class="form-control" placeholder="{{ $row->title ?? $row->name ?? __("Enter title...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                    </div>
                    <div class="form-group mb-3">
                        <label class="control-label mb-2">{{__("Twitter Description")}}</label>
                        <textarea name="seo_share[twitter][desc]" rows="3" class="form-control" placeholder="{{trim(strip_tags($row->short_desc)) ?? __("Enter description...")}}">{{$seo_share['twitter']['desc'] ?? "" }}</textarea>
                    </div>
                    @if(is_default_lang())
                        <div class="form-group mb-3 form-group mb-3-image">
                            <label class="control-label mb-2">{{__("Twitter Image")}}</label>
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ) !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
