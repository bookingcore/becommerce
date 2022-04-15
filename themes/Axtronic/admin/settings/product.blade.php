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
                        <label for="header_contact">{{__("Header Contact  ")}}</label>
                        <div class="form-controls">
                            <div class="form-controls">
                                <input type="text" id="header_contact" class="form-control" name="axtronic_header_contact" value="{{setting_item('axtronic_header_contact')}}">
                            </div>
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
                                        $social_share = setting_item_with_lang('axtronic_product_category',request()->query('lang'));
                                        if(!empty($social_share)) $social_share = json_decode($social_share,true);
                                        if(empty($social_share) or !is_array($social_share))
                                            $social_share = [];
                                        ?>
                                        @foreach($social_share as $key=>$item)
                                            <div class="item" data-number="{{$key}}">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" name="axtronic_product_category[{{$key}}][title]" class="form-control" value="{{$item['title']}}">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <select class="form-control" name="axtronic_product_category[{{$key}}][size]">
                                                            <option @if(!empty($item['size']) && $item['size']=='2') selected @endif value="2">1/6</option>
                                                            <option @if(!empty($item['size']) && $item['size']=='3') selected @endif value="3">1/4</option>
                                                            <option @if(!empty($item['size']) && $item['size']=='4') selected @endif value="4">1/3</option>
                                                            <option @if(!empty($item['size']) && $item['size']=='6') selected @endif value="6">1/2</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <textarea name="axtronic_product_category[{{$key}}][content]" rows="5" class="form-control">{{$item['content']}}</textarea>
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
                                                    <input type="text" __name__="axtronic_product_category[__number__][title]" class="form-control" value="">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" __name__="axtronic_product_category[__number__][size]">
                                                        <option value="3">1/4</option>
                                                        <option value="4">1/3</option>
                                                        <option value="6">1/2</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <textarea __name__="axtronic_product_category[__number__][content]" class="form-control" rows="5"></textarea>
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
</div>
