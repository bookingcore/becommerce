@extends('layouts.vendor')
@section('content')
    <section class="bc-items-listing">
        <div class="d-flex justify-content-between mb-4">
            <h1>{{$page_title ?? ''}}</h1>
        </div>
        <form action="{{ route('vendor.profileStore') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="container-fluid">
                @include('global.message')
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Vendor Info')}}</strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Business Name')}} <span class="text-danger">*</span></label>
                                            <input type="email" required value="{{old('business_name',$row->business_name)}}" placeholder="{{ __('Business Name')}}" name="business_name" class="form-control"  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Publish')}}</strong></div>
                            <div class="panel-body">
                                <div class="d-flex justify-content-between">
                                    <span></span>
                                    <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Avatar')}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    {!! \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span></span>
                    <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                </div>
            </div>
        </form>


    </section>
@endsection
