<?php
$tabs = get_admin_product_tabs();
$product_types = get_product_types();
?>

@extends('admin.layouts.app')

@section('content')
    <form action="{{route('product.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" >
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->title : __('Add new product')}}</h1>
                    @if($row->slug)
                        <p class="item-url-demo mt-2">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                            <input type="hidden" name="slug" value="{{$row->slug}}">
                        </p>
                    @endif
                </div>
                <div class="">
                    <?php do_action(\Modules\Product\Hook::FORM_BEFORE_PREVIEW_BUTTON,$row) ?>
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{__("View Product")}}</a>
                    @endif
                </div>
            </div>
            @include('Layout::admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("General Information")}}</strong></div>
                            <div class="panel-body">
                                @include('Product::admin.product.general')
                            </div>
                        </div>
                        <div class="panel product-information-tabs">
                            <div class="panel-title d-flex justify-content-between">
                                <div class="d-flex justify-content-center align-items-center">
                                    <strong class="flex-shrink-0 mr-3">{{__("Product Information")}}</strong>
                                    <select @if(!is_default_lang()) readonly="" disabled @endif class="form-control @if(count($product_types) <= 1) d-none  @endif" name="product_type">
                                        <optgroup label="{{__("Product Type")}}">
                                            @foreach($product_types as $type_id=>$type)
                                                <option @if($row->product_type == $type_id) selected @endif value="{{$type_id}}">{{$type::getTypeName()}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="panel-body no-padding">
                                <input type="hidden" name="tab" value="{{request('tab')}}">
                                <div class="row">
                                    <div class="col-xl-2 col-nav">
                                        <ul class="nav nav-tabs flex-column vertical-nav">
                                            @php $i = 0; $active_tab = '' @endphp
                                            @foreach($tabs as $tab_id=>$tab)
                                                @php if(!$i) $active_tab = $tab_id @endphp
                                                <li class="nav-item" @if(!empty($tab['condition'])) data-condition="{{$tab['condition']}}" @endif><a class="nav-link @if(!$i) active @endif"  href="#{{$tab_id}}" data-toggle="tab">
                                                        @if(!empty($tab['icon']))
                                                            <i class="nav-icon {{$tab['icon']}}"></i>
                                                        @endif
                                                        {{$tab['title']}}</a>
                                                </li>
                                                @php $i++ @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-xl-10 col-content">
                                        <div class="tab-content">
                                            @php $i = 0 @endphp
                                            @foreach($tabs as $tab_id=>$tab)
                                                <div data-product-id="{{$row->id}}" class="tab-pane fade @if($active_tab == $tab_id) show active @endif" id="{{$tab_id}}">
                                                    @include($tab['view'],['product'=>$product,'is_admin_page'=>1])
                                                </div>
                                                @php $i++ @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("Short Desc & Gallery")}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                    <div class="form-group mb-3">
                                        <label class="control-label mb-2">{{__("Gallery")}}</label>
                                        {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
                                    </div>
                                @endif
                                <div class="form-group mb-3">
                                    <label class="control-label mb-2">{{__("Short Desc")}}</label>
                                    <textarea name="short_desc" class="d-none has-tinymce" cols="30"  >{{old('short_desc',$translation->short_desc)}}</textarea>
                                </div>
                            </div>
                        </div>
                        @include("Core::admin.seo-meta.seo-meta")
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                <div class="form-group">
                                    <label>{{__('Status')}}</label>
                                        <select name="status" class="custom-select form-select">
                                            <option value="publish">{{__("Publish")}}</option>
                                            <option @if($row->status=='pending') selected @endif value="pending">{{__("Pending")}}</option>
                                            <option @if($row->status=='draft') selected @endif value="draft">{{__("Draft")}}</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>{{__('Is Approved?')}}</label>
                                    <select name="is_approved" class="custom-select form-select">
                                        <option @if($row->status=='1') selected @endif value="1">{{__("Yes")}}</option>
                                        <option @if($row->status=='0') selected @endif value="0">{{__("No")}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="controls">
                                        <label class="mb-0">
                                            <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("This is a featured product")}}
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label >{{__('Author')}}</label>
                                    <?php
                                    $user = !empty($row->author_id) ? App\User::find($row->author_id) : false;
                                    \App\Helpers\AdminForm::select2('author_id', [
                                        'configs' => [
                                            'ajax'        => [
                                                'url' => url('/admin/module/user/getForSelect2'),
                                                'dataType' => 'json'
                                            ],
                                            'allowClear'  => true,
                                            'placeholder' => __('-- Select Author --')
                                        ]
                                    ], !empty($user->id) ? [
                                        $user->id,
                                        $user->display_name . ' (#' . $user->id . ')'
                                    ] : false)
                                    ?>
                                </div>
                                @endif
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                            </div>
                        </div>
                        @if(is_default_lang())
                        <div class="panel">
                            <div class="panel-title"> <strong>{{ __('Category')}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    @include('Product::admin.product.categories')
                                </div>
                            </div>
                        </div>
                            <div class="panel">
                                <div class="panel-title"> <strong>{{ __('Feature Image')}}</strong></div>
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

@push ('script.body')
    <script src="{{asset('libs/handlebars/handlebars.min.js')}}"></script>
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endpush
