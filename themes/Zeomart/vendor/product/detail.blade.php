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
            <div class="flex justify-between mb-16">
                <div class="">
                    <h2 class="text-3xl font-medium">{{$page_title ?? ''}}</h2>
                    @if($row->slug)
                        <p class="item-url-demo mt-2">{{__("Permalink")}}: {{ url('product' ) }}/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                            <input type="hidden" name="slug" value="{{$row->slug}}">
                        </p>
                    @endif
                </div>
                <div class="bc-section__actions">
                    @if(!empty($row->id))
                    <a class="inline-flex items-center p-4 py-2 bg-white rounded items-center border border-gray-300 shadow-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{$row->getDetailUrl()}}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        {{__('View Product')}}</a>
                    @endif
                </div>
            </div>
            @include('global.message')
            <div class="mb-5">
                @if($row->id)
                    @include('Language::admin.navigation')
                @endif
            </div>
            <form action="{{route('vendor.product.store',['id'=>$row->id,'lang'=>request()->query('lang')])}}" method="post">
                @csrf
                <div class="@if($row->id) lang-content-box text-base @endif">
                    <div class="flex gap-4">
                        <div class="w-3/4">
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("General Information")}}</strong></div>
                                <div class="panel-body">
                                    @include('Product::admin.product.general')
                                </div>
                            </div>
                            <div class="panel product-information-tabs !p-0">
                                <div class="panel-title d-flex justify-content-between px-7 py-8 !m-0">
                                    <div class="flex items-center">
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
                                    <div class="flex be-tabs">
                                        <div class="w-1/6 bg-gray-100 shrink-0">
                                            <ul class="nav nav-tabs flex-column vertical-nav py-2">
                                                @php $i = 0; $active_tab = '' @endphp
                                                @foreach($tabs as $tab_id=>$tab)
                                                    @php if(!$i) $active_tab = $tab_id @endphp
                                                    <li class="nav-item" @if(!empty($tab['condition'])) data-condition="{{$tab['condition']}}" @endif><a class="text-gray-700 text-blue-600 block px-4 py-2 text-base hover:bg-white @if(!$i) bg-white @endif"  href="#{{$tab_id}}" data-bs-toggle="tab">
                                                            @if(!empty($tab['icon']))
                                                                <i class="nav-icon {{$tab['icon']}}"></i>
                                                            @endif
                                                            {{$tab['title']}}</a>
                                                    </li>
                                                    @php $i++ @endphp
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="w-5/6 grow">
                                            <div class="tab-content p-4">
                                                @php $i = 0 @endphp
                                                @foreach($tabs as $tab_id=>$tab)
                                                    <div data-product-id="{{$row->id}}" class="tab-pane  @if($active_tab == $tab_id) block active @else hidden @endif" id="{{$tab_id}}">
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
                                            {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery,['tailwind'=>true]) !!}
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
                        <div class="w-1/4">
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
                                </div>
                                <div class="panel-footer rounded-b-16">
                                    <button class="btn bg-amber-300 hover:bg-amber-400 inline-flex items-center" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        {{__('Save Changes')}}</button>
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
    <script src="{{ asset('libs/select2/js/select2.min.js') }}" ></script>
    <script src="{{asset('libs/handlebars/handlebars.min.js')}}"></script>
    <script  src="{{ theme_url('Zeomart/dist/js/vendor.js?_v='.config('app.asset_version')) }}"></script>
@endpush
