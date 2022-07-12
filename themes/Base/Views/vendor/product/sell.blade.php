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
                <div class="@if($row->id) lang-content-box @endif">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel">
                                <div class="panel-title"><strong>{{__("General Information")}}</strong></div>
                                <div class="panel-body">
                                    @include('Product::admin.product.general')
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label mb-2">{{__('Status')}}</label>
                                        <select name="status" class="custom-select form-select">
                                            <option value="publish">{{__("Publish")}}</option>
                                            <option @if($row->status=='draft') selected @endif value="draft">{{__("Draft")}}</option>
                                        </select>
                                    </div>
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
    <script src="{{theme_url('/Base/vendor/js/form.js')}}"></script>
    <script src="{{asset('module/product/admin/js/product.js')}}"></script>
@endpush
