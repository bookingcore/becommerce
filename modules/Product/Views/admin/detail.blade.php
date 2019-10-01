<?php
use Modules\Product\Models\ProductBrand;
;?>

@extends('admin.layouts.app')

@section('content')
    <form action="{{route('product.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->title : __('Add new product')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->id)
                        <a class="btn btn-warning btn-sm" href="{{route('product.admin.variation.index',['id'=>$row->id])}}" target=""><i class="fa fa-sliders"></i> {{__("Manage Variations")}}</a>
                    @endif
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{__("View Product")}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        @include('Product::admin.product.content')
                        @include('Product::admin.product.pricing')
                        {{--@include('Product::admin.product.variations')--}}
                        @include('Core::admin/seo-meta/seo-meta')
                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Author Setting")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <?php
	                                    $user = !empty($row->create_user) ? App\User::find($row->create_user) : false;
                                        \App\Helpers\AdminForm::select2('create_user', [
                                            'configs' => [
                                                'ajax'        => [
                                                    'url' => url('/admin/module/user/getForSelect2'),
                                                    'dataType' => 'json'
                                                ],
                                                'allowClear'  => true,
                                                'placeholder' => __('-- Select User --')
                                            ]
                                        ], !empty($user->id) ? [
                                            $user->id,
                                            $user->getDisplayName() . ' (#' . $user->id . ')'
                                        ] : false)
                                        ?>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                    <div class="form-group">
                                    <div>
                                        <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                        </label></div>
                                    <div>
                                        <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                        </label></div>
                                    </div>

                                    <div class="form-group">
                                        <label><strong>{{__('Featured Status')}}</strong></label>
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("Is featured product ?")}}
                                        </label>
                                    </div>
                                @endif
                                    <hr>
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </div>
                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Categories")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="terms-scrollable">
                                            <?php
                                                $categoriesArray   = $row->categories->pluck("id")->toArray();

                                            $traverse = function ($categories, $prefix = '') use (&$traverse, $categoriesArray) {

                                                foreach ($categories as $category) {
                                                    $selected = '';
                                                    if (in_array($category->id,$categoriesArray))
                                                        $selected = 'checked';
                                                    printf("<label class='term-item'><input type='checkbox' name='category_ids[]' value='%s' %s><span class='term-name'>%s</span></label>", $category->id, $selected, $prefix . ' ' . $category->name);
                                                    $traverse($category->children, $prefix . '-');
                                                }
                                            };
                                            $traverse($categories);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Tags")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div class="">
                                            <input type="text" data-role="tagsinput" autocomplete="off" value="" placeholder="{{ __('Enter tag')}}" name="tag" class="form-control tag-input">
                                            <br>
                                            <div class="show_tags">
                                                @if(count($row->tags)>0)
                                                    @foreach($row->tags as $tag)
                                                        <span class="tag_item">{{$tag->name}}<span data-role="remove"></span>
                                                            <input type="hidden" name="tag_ids[]" value="{{$tag->id}}">
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("Brand")}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
		                                <?php
		                                $brand = !empty($row->brand_id) ? ProductBrand::find($row->brand_id) : false;
		                                \App\Helpers\AdminForm::select2('brand_id', [
			                                'configs' => [
				                                'ajax'        => [
					                                'url' => route('product.admin.brand.getForSelect2'),
					                                'dataType' => 'json'
				                                ],
				                                'allowClear'  => true,
				                                'placeholder' => __('-- Select Brand --')
			                                ]
		                                ], !empty($brand->id) ? [
			                                $brand->id,
			                                $brand->name . ' (#' . $brand->id . ')'
		                                ] : false)
		                                ?>
                                    </div>
                                </div>
                            </div>
                            @include('Product::admin.product.attributes')
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Feature Image')}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section ('script.body')
@endsection