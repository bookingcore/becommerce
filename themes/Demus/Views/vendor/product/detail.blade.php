@extends('layouts.vendor')
@push('head')
    <script src="{{ asset('libs/tinymce/js/tinymce/tinymce.min.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('libs/select2/css/select2.min.css') }}" />
    <style>
        body{
            background: #f8f9fa;
        }
    </style>
@endpush
@section('content')
    <section class="bc-items-listing">
        <div class="bc-section__content">
            <div class="d-flex justify-content-between mb-4">
                <div class="">
                    <h2>{{$page_title ?? ''}}</h2>
                    @if($row->slug)
                        <p class="item-url-demo mt-2">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                            <input type="hidden" name="slug" value="{{$row->slug}}">
                        </p>
                    @endif
                </div>
                <div class="bc-section__actions">
                    @if(!empty($row->id))
                    <a class="btn btn-primary" href="{{$row->getDetailUrl()}}" target="_blank"><i class="fa fa-eye"></i> {{__('View Product')}}</a>
                    @endif
                </div>
            </div>
            @include('global.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <form action="{{route('vendor.product.store',['id'=>$row->id,'lang'=>request()->query('lang')])}}" method="post">
                @csrf
                <div class="@if($row->id) lang-content-box @endif">
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
                                        <select @if(!is_default_lang()) readonly="" disabled @endif class="form-select" name="product_type">
                                            <optgroup label="{{__("Product Type")}}">
                                                @foreach(get_product_types() as $type_id=>$type)
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
                                                    <li class="nav-item" @if(!empty($tab['condition'])) data-condition="{{$tab['condition']}}" @endif><a class="nav-link @if(!$i) active @endif"  href="#{{$tab_id}}" data-bs-toggle="tab">
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
                                                        @include($tab['view'],['product'=>$product,'is_admin_page'=>0,'bs5'=>1])
                                                    </div>
                                                    @php $i++ @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('Product::admin.product.downloadable')
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
                                    @if(is_default_lang() and (!vendor_product_need_approve() or $row->is_approved))
                                        <div class="form-group">
                                            <label class="control-label mb-2">{{__('Status')}}</label>
                                            <select name="status" class="custom-select form-select">
                                                <option value="publish">{{__("Publish")}}</option>
                                                <option @if($row->status=='draft') selected @endif value="draft">{{__("Draft")}}</option>
                                            </select>
                                        </div>
                                    @endif
                                    <hr>
                                    <div class="form-group">
                                        <div class="controls">
                                            <label class="mb-0" aata-toggle="tooltip" data-placement="top" title="{{__("Virtual product does not need shipping")}}">
                                                <input type="checkbox" name="is_virtual" @if($row->is_virtual) checked @endif value="1"> {{__("This is a virtual product")}}
                                            </label>
                                        </div>
                                    </div>
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

            </form>
        </div>
    </section>
@endsection
@push('footer')
    <script src="{{asset('libs/handlebars/handlebars.min.js')}}"></script>
    <script src="{{ asset('libs/bootbox/bootbox.min.js') }}"></script>
    <script src="{{ asset('libs/select2/js/select2.min.js') }}" ></script>
    <script src="{{theme_url('/demus/vendor/js/form.js')}}"></script>
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endpush
