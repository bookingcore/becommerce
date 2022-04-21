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
                            <select name="freshen_product_gallery" class="form-control">
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
<div class="row mb-3">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Product Search Page Settings')}}</h3>
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
                                <select name="fs_search_layout" class="form-control">
                                    @for($i=1;$i<=6;$i++)
                                        <option @if(setting_item('fs_search_layout')==$i) selected @endif value="{{$i}}">{{__('Layout :number',['number'=>$i])}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>{{__("Search page item layout")}}</label>
                            <div class="form-controls">
                                <select name="fs_search_item_layout" class="form-control">
                                    <option value="">{{__("Gird")}}</option>
                                    <option @if(setting_item('fs_search_layout')=='list') selected @endif value="list">{{__("List")}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3" data-condition="fs_search_layout:is(6)">
                        <label class="control-label mb-2">{{__("Search page top category")}}</label>
                        <div class="form-controls">
                            <input type="text" name="fs_search_top_category_ids" class="form-control" value="{{setting_item("fs_search_top_category_ids")}}">
                            <p><code>{{__('Example: 1,2,3,4,5,6')}}</code></p>
                        </div>
                    </div>
                    <div class="form-group mb-3" data-condition="fs_search_layout:is(4)">
                        <label class="control-label mb-2">{{__("Search page Product ids")}}</label>
                        <div class="form-controls">
                            <input type="text" name="fs_search_top_product_ids" class="form-control" value="{{setting_item("fs_search_top_product_ids")}}">
                            <p><code>{{__('Example: 1,2,3,4,5,6')}}</code></p>
                        </div>
                    </div>
                    <div class="form-group" data-condition="fs_search_layout:is(5)">
                        <label><strong>{{__("Search page items carousel")}}</strong></label>
                        <div class="form-controls">
                            <div class="form-group-item">
                                <div class="form-group-item">
                                    <div class="g-items-header">
                                        <div class="row">
                                            <div class="col-md-6">{{__("Content")}}</div>
                                            <div class="col-md-3">{{__("Image")}}</div>
                                            <div class="col-md-2">{{__('Order')}}</div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>
                                    <div class="g-items">
                                        <?php
                                        $items = json_decode(setting_item('fs_search_top_carousel'));
                                        if (empty($items) or !is_array($items)) $items = [];
                                        ?>
                                        @foreach($items as $key=>$item)
                                            <div class="item" data-number="{{$key}}">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{__("Title")}}</label>
                                                            <input type="text" name="fs_search_top_carousel[{{$key}}][title]" class="form-control" value="{{$item->title ?? ''}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{__("Sub Title")}}</label>
                                                            <input type="text" name="fs_search_top_carousel[{{$key}}][sub_title]" class="form-control" value="{{$item->sub_title ?? ''}}">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>{{__("Description")}}</label>
                                                            <textarea name="fs_search_top_carousel[{{$key}}][desc]" class="form-control" cols="15" rows="4">{{$item->desc ?? ''}}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>{{__("Button")}}</label>
                                                            <input type="text" name="fs_search_top_carousel[{{$key}}][button_text]" class="form-control" value="{{$item->button_text ?? ''}}" placeholder="{{__('Text button')}}">
                                                            <input type="text" name="fs_search_top_carousel[{{$key}}][button_link]" class="form-control" value="{{$item->button_link ?? ''}}" placeholder="{{__('Link Button')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">{{__('Image')}}</label>
                                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('fs_search_top_carousel['.$key.'][image_id]',$item->image_id??"") !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="number" name="fs_search_top_carousel[{{$key}}][order]" class="form-control" value="{{$item->order ?? ''}}">
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{__("Title")}}</label>
                                                        <input type="text" __name__="fs_search_top_carousel[__number__][title]" class="form-control" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{__("Sub Title")}}</label>
                                                        <input type="text" __name__="fs_search_top_carousel[__number__][sub_title]" class="form-control" value="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>{{__("Description")}}</label>
                                                        <textarea __name__="fs_search_top_carousel[__number__][desc]" class="form-control" cols="15" rows="4"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>{{__("Button")}}</label>
                                                        <input type="text" __name__="fs_search_top_carousel[__number__][button_text]" class="form-control" value="" placeholder="{{__('Text button')}}">
                                                        <input type="text" __name__="fs_search_top_carousel[__number__][button_link]" class="form-control" value="" placeholder="{{__('Link Button')}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('fs_search_top_carousel[__number__][image_id]','','__name__') !!}
                                                </div>

                                                <div class="col-md-2">
                                                    <input type="number" __name__="fs_search_top_carousel[__number__][order]" class="form-control" value="">
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
                @endif
            </div>
        </div>
    </div>
</div>
