<?php
use Modules\Product\Models\ProductAttr;
?>

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
                                    <option @if(setting_item('fs_search_layout')== 'left-sidebar') selected @endif value="left-sidebar">{{__('Left Sidebar')}}</option>
                                    <option @if(setting_item('fs_search_layout')== 'right-sidebar') selected @endif value="right-sidebar">{{__('Right Sidebar')}}</option>
                                    <option @if(setting_item('fs_search_layout')== 'no-sidebar') selected @endif value="no-sidebar">{{__('No Sidebar')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>{{__("Search page item layout")}}</label>
                            <div class="form-controls">
                                <select name="fs_search_item_layout" class="form-control">
                                    <option @if(setting_item('fs_search_item_layout')=='gird') selected @endif value="gird">{{__("Gird")}}</option>
                                    <option @if(setting_item('fs_search_item_layout')=='list') selected @endif value="list">{{__("List")}}</option>
                                </select>
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
        <h3 class="form-group-title">{{__("Sidebar Options")}}</h3>
        <p class="form-group-desc">{{__('Config sidebar for product')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-8">{{__("Title")}}</div>
                                    <div class="col-md-3">{{__('Type')}}</div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="g-items">
                                <?php
                                $fs_products_sidebar = setting_item_with_lang_arr('fs_products_sidebar',request()->query('lang'));
                                if(empty($fs_products_sidebar)) $fs_products_sidebar = [];
                                $attrProduct = ProductAttr::where('service','product')->get();
                                ?>
                                @foreach($fs_products_sidebar as $key=>$item)
                                    <div class="item" data-number="{{$key}}">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="text" name="fs_products_sidebar[{{$key}}][title]" class="form-control" placeholder="{{__('Title: About Us')}}" value="{{$item['title'] ?? ''}}">
                                                <textarea name="fs_products_sidebar[{{$key}}][content]" rows="2" class="form-control" placeholder="{{__("Content")}}">{{$item['content'] ?? ''}}</textarea>
                                                <div class="form-group" data-condition="'fs_products_sidebar[{{$key}}][type]':is(attr)">
                                                    <label for="">{{__("Attribute")}}</label>
                                                    <select name="fs_products_sidebar[{{$key}}][attr]" class="form-control">
                                                        <option value="">{{__('-- Select --')}}</option>
                                                    @foreach($attrProduct as  $attr)
                                                                <option @if(!empty($item['attr']) && $item['attr']==$attr->id) selected @endif value="{{$attr->id}}">{{$attr->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control" name="fs_products_sidebar[{{$key}}][type]">
                                                    <option @if(!empty($item['type']) && $item['type']=='price') selected @endif value="price">{{__("Price")}}</option>
                                                    <option @if(!empty($item['type']) && $item['type']=='category') selected @endif value="category">{{__("Category")}}</option>
                                                    <option @if(!empty($item['type']) && $item['type']=='attr') selected @endif value="attr">{{__("Attribute")}}</option>
                                                    <option @if(!empty($item['type']) && $item['type']=='tag') selected @endif value="tag">{{__("Tags")}}</option>
                                                    <option @if(!empty($item['type']) && $item['type']=='review') selected @endif value="review">{{__("Review")}}</option>
                                                    <option @if(!empty($item['type']) && $item['type']=='brand') selected @endif value="brand">{{__("Brands")}}</option>
                                                    <option @if(!empty($item['type']) && $item['type']=='content_text') selected @endif value="content_text">{{__("Content Text")}}</option>
                                                </select>


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
                                        <div class="col-md-8">
                                            <input type="text" __name__="fs_products_sidebar[__number__][title]" class="form-control" placeholder="{{__('Title: About Us')}}">
                                            <textarea __name__="fs_products_sidebar[__number__][content]" rows="3" class="form-control" placeholder="{{__("Content")}}"></textarea>
                                            <div class="form-group" data-condition="'fs_products_sidebar[__number__][type]':is(attr)">
                                                <select __name__="fs_products_sidebar[__number__][attr]" class="form-control">
                                                    <option value="">{{__('-- Select --')}}</option>
                                                    @foreach($attrProduct as  $attr)
                                                        <option value="{{$attr->id}}">{{$attr->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" __name__="fs_products_sidebar[__number__][type]">
                                                <option value="price">{{__("Price")}}</option>
                                                <option value="category">{{__("Category")}}</option>
                                                <option value="attr">{{__("Attr")}}</option>
                                                <option value="tag">{{__("Tags")}}</option>
                                                <option value="review">{{__("Review")}}</option>
                                                <option value="brand">{{__("Brands")}}</option>
                                                <option value="content_text">{{__("Content Text")}}</option>
                                            </select>
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
        </div>
    </div>
</div>
