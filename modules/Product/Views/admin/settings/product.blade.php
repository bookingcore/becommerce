<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Product page settings")}}</h3>
        <p class="form-group-desc">{{__('Config product page settings of your website')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("General Options")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="" >{{__("Title Page")}}</label>
                    <div class="form-controls">
                        <input type="text" name="product_page_search_title" value="{{setting_item_with_lang('product_page_search_title',request()->query('lang'))}}" class="form-control">
                    </div>
                </div>
                @if(is_default_lang())
                    <div class="form-group">
                        <label class="" >{{__("Products Per Page")}}</label>
                        <div class="form-controls">
                            <input type="number" name="products_per_page" value="{{setting_item_with_lang('products_per_page',request()->query('lang'), 12)}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="" >{{__("Slider Page")}}</label>
                        <div class="form-controls">
                            <div class="form-group-item">
                                <div class="g-items-header">
                                    <div class="row">
                                        <div class="col-md-2">{{__('Image')}}</div>
                                        <div class="col-md-7">{{__("Title/Content")}}</div>
                                        <div class="col-md-1"></div>
                                    </div>
                                </div>
                                <div class="g-items">
                                    <?php
                                    $list_sliders = [];
                                    if(!empty($settings['list_sliders'])){
                                    $list_sliders  = $settings['list_sliders'];
                                    $list_sliders = json_decode(setting_item_with_lang('list_sliders',request()->query('lang'),$settings['list_sliders'] ?? "[]"));
                                    ?>
                                    @foreach($list_sliders as $key=>$item)
                                        <div class="item" data-number="{{$key}}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('list_sliders['.$key.'][image_id]',$item->image_id) !!}
                                                </div>
                                                <div class="col-md-7">
                                                    <input type="text" name="list_sliders[{{$key}}][title]" class="form-control" placeholder="{{__('Title')}}" value="{{$item->title}}">
                                                    <textarea name="list_sliders[{{$key}}][content]" rows="2" class="form-control" placeholder="{{__("Content")}}">{{$item->content}}</textarea>
                                                </div>
                                                <div class="col-md-1">
                                                    <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <?php } ?>
                                </div>
                                <div class="text-right">
                                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                                </div>
                                <div class="g-more hide">
                                    <div class="item" data-number="__number__">
                                        <div class="row">
                                            <div class="col-md-4">
                                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('list_sliders[__number__][image_id]','','__name__') !!}
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" __name__="list_sliders[__number__][title]" class="form-control" placeholder="{{__('Title')}}">
                                                <textarea __name__="list_sliders[__number__][content]" rows="3" class="form-control" placeholder="{{__("Content")}}"></textarea>
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
                @endif
            </div>
        </div>
        <div class="panel">
            <div class="panel-title"><strong>{{__("SEO Options")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#seo_1">{{__("General Options")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_2">{{__("Share Facebook")}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#seo_3">{{__("Share Twitter")}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" >
                        <div class="tab-pane active" id="seo_1">
                            <div class="form-group" >
                                <label class="control-label">{{__("Seo Title")}}</label>
                                <input type="text" name="product_page_list_seo_title" class="form-control" placeholder="{{__("Enter title...")}}" value="{{ setting_item_with_lang('product_page_list_seo_title',request()->query('lang'))}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Seo Description")}}</label>
                                <input type="text" name="product_page_list_seo_desc" class="form-control" placeholder="{{__("Enter description...")}}" value="{{setting_item_with_lang('product_page_list_seo_desc',request()->query('lang'))}}">
                            </div>
                            @if(is_default_lang())
                                <div class="form-group form-group-image">
                                    <label class="control-label">{{__("Featured Image")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('product_page_list_seo_image', $settings['product_page_list_seo_image'] ?? "" ) !!}
                                </div>
                            @endif
                        </div>
                        @php
                            $seo_share = json_decode(setting_item_with_lang('product_page_list_seo_desc',request()->query('lang'),'[]'),true);
                        @endphp
                        <div class="tab-pane" id="seo_2">
                            <div class="form-group">
                                <label class="control-label">{{__("Facebook Title")}}</label>
                                <input type="text" name="product_page_list_seo_share[facebook][title]" class="form-control" placeholder="{{__("Enter title...")}}" value="{{$seo_share['facebook']['title'] ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Facebook Description")}}</label>
                                <input type="text" name="product_page_list_seo_share[facebook][desc]" class="form-control" placeholder="{{__("Enter description...")}}" value="{{$seo_share['facebook']['desc'] ?? "" }}">
                            </div>
                            @if(is_default_lang())
                                <div class="form-group form-group-image">
                                    <label class="control-label">{{__("Facebook Image")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('product_page_list_seo_share[facebook][image]',$seo_share['facebook']['image'] ?? "" ) !!}
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane" id="seo_3">
                            <div class="form-group">
                                <label class="control-label">{{__("Twitter Title")}}</label>
                                <input type="text" name="product_page_list_seo_share[twitter][title]" class="form-control" placeholder="{{__("Enter title...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{__("Twitter Description")}}</label>
                                <input type="text" name="product_page_list_seo_share[twitter][desc]" class="form-control" placeholder="{{__("Enter description...")}}" value="{{$seo_share['twitter']['title'] ?? "" }}">
                            </div>
                            @if(is_default_lang())
                                <div class="form-group form-group-image">
                                    <label class="control-label">{{__("Twitter Image")}}</label>
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('product_page_list_seo_share[twitter][image]', $seo_share['twitter']['image'] ?? "" ) !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Review Options")}}</h3>
            <p class="form-group-desc">{{__('Config review for product')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Write review")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="product_enable_review" value="1" @if(!empty($settings['product_enable_review'])) checked @endif /> {{__("On Review")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Turn on the mode for reviewing product")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="product_enable_review:is(1)">
                        <label class="" >{{__('Reviews can only be left by "verified owners"')}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="product_review_verification_required" value="1"  @if(!empty($settings['product_review_verification_required'])) checked @endif /> {{__("On")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("ON: Only post a review after booking - Off: Post review without booking")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="product_enable_review:is(1)">
                        <label class="" >{{__("Review approved")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="product_review_approved" value="1"  @if(!empty($settings['product_review_approved'])) checked @endif /> {{__("On approved")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("ON: Review must be approved by admin - OFF: Review is automatically approved")}}</small>
                        </div>
                    </div>
                    <div class="form-group" data-condition="product_enable_review:is(1)">
                        <label class="" >{{__("Review number per page")}}</label>
                        <div class="form-controls">
                            <input type="number" class="form-control" name="product_review_number_per_page" value="{{ $settings['product_review_number_per_page'] ?? 5 }}" />
                            <small class="form-text text-muted">{{__("Break comments into pages")}}</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endif

@if(is_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Inventory Options")}}</h3>
            <p class="form-group-desc">{{__('Configure inventory for products')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" >{{__("Enable stock management")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="product_enable_stock_management" value="1" @if(!empty($settings['product_enable_stock_management'])) checked @endif /> {{__("On")}} </label>
                        </div>
                    </div>

                    <div class="form-group" data-condition="product_enable_stock_management:is(1)">
                        <label class="" >{{__("Hold stock (minutes)")}}</label>
                        <div class="form-controls">
                            <input type="number" class="form-control" name="product_hold_stock" value="{{ $settings['product_hold_stock'] ?? 60 }}" />
                            <small class="form-text text-muted">{{__("Hold stock (for unpaid orders) for x minutes. When this limit is reached, the pending order will be cancelled. Leave blank to disable.")}}</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="" >{{__("Hide out of stock items from the product page?")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="product_hide_products_out_of_stock" value="1"  @if(!empty($settings['product_hide_products_out_of_stock'])) checked @endif /> {{__("On")}} </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Policies Options")}}</h3>
        <p class="form-group-desc">{{__('Config policies for product')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <div class="form-controls">
                        <div class="form-group-item">
                            <div class="g-items-header">
                                <div class="row">
                                    <div class="col-md-11 text-left">{{__("Title - Content")}}</div>
                                    <div class="col-md-1"></div>
                                </div>
                            </div>
                            <div class="g-items">
                                <?php
                                $product_policies = [];
                                if(!empty($settings['product_policies'])){
                                $product_policies  = $settings['product_policies'];
                                $product_policies = json_decode(setting_item_with_lang('product_policies',request()->query('lang'),$settings['product_policies'] ?? "[]"));
                                ?>
                                @foreach($product_policies as $key=>$item)
                                    <div class="item" data-number="{{$key}}">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <input type="text" name="product_policies[{{$key}}][title]" class="form-control" placeholder="{{__('Title')}}" value="{{$item->title}}">
                                                <textarea name="product_policies[{{$key}}][content]" rows="2" class="form-control" placeholder="{{__("Content")}}">{{$item->content}}</textarea>
                                            </div>
                                            <div class="col-md-1">
                                                <span class="btn btn-danger btn-sm btn-remove-item"><i class="fa fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <?php } ?>
                            </div>
                            <div class="text-right">
                                <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add item')}}</span>
                            </div>
                            <div class="g-more hide">
                                <div class="item" data-number="__number__">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <input type="text" __name__="product_policies[__number__][title]" class="form-control" placeholder="{{__('Title')}}">
                                            <textarea __name__="product_policies[__number__][content]" rows="3" class="form-control" placeholder="{{__("Content")}}"></textarea>
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


