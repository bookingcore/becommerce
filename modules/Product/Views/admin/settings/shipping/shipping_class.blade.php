@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="mb40">
            <div class="d-flex justify-content-between">
                <h1 class="title-bar">{{ __("Shipping Class") }}</h1>
            </div>
            <hr>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="/admin/module/core/settings/index/shipping" class="btn btn-sm btn-default"><i class="fa fa-arrow-circle-o-left"></i> {{ __("Shipping Settings") }}</a>
            </div>

            <div class="col-md-12">
                <form action="{{ route('product.shipping.class.store') }}" method="post" autocomplete="off">
                    @csrf

                    @include('Language::admin.navigation')

                    <div class="lang-content-box">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="">{{__("Shipping Class")}} <span class="text-danger">*</span></label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" required name="name" value="{{ $translation->name ?? old('name') }}">
                                            </div>
                                        </div>

                                        @if(is_default_lang())
                                            <div class="form-group">
                                                <label class="">{{__("Slug")}}</label>
                                                <div class="form-controls">
                                                    <input type="text" class="form-control" name="slug" value="{{ $row->slug ?? old('slug') }}">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="">{{__("Description")}}</label>
                                            <div class="form-controls">
                                                <textarea name="description" class="form-control">{{ $translation->description ?? old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <input type="hidden" name="shipping_class_id" value="{{ $row->id ?? '' }}" />
                        <button class="btn btn-primary" type="submit">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
