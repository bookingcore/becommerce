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
                        <p class="item-url-demo mt-2">{{__("Permalink")}}: {{ url('product' ) }}/{{$row->slug}}
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
            <form action="{{route('vendor.product.sell.store',['product'=>$row])}}" method="post">
                @csrf
                <div >
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel">
                                <div class="panel-title"><strong>{{$row->title}}</strong></div>
                                <div class="panel-body">
                                    @include('vendor.product.sell.form')
                                </div>
                            </div>
                            @include('vendor.product.sell.variations')
                        </div>
                        <div class="col-md-3">
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label mb-2">{{__('Status')}}</label>
                                        <select name="active" class="custom-select form-select">
                                            <option value="">{{__("Draft")}}</option>
                                            <option @if(old('active',$product_vendor->active)) selected @endif value="1">{{__("Publish")}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                            @if(is_default_lang())
                                <div class="panel">
                                    <div class="panel-title"> <strong>{{ __('Feature Image')}}</strong></div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',old('image_id',$product_vendor->image_id)) !!}

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
    <script src="{{theme_url('/Base/vendor/js/form.js')}}"></script>
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endpush
