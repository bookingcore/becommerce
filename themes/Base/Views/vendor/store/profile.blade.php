@extends('layouts.vendor')
@section('content')
    <section class="bc-items-listing">
        <div class="d-flex justify-content-between mb-4">
            <h1>{{$page_title ?? ''}}</h1>
        </div>
        <form action="{{ route('vendor.profile.store') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="container-fluid">
                @include('global.message')
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Store Info')}}</strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">{{ __('Business Name')}} <span class="text-danger">*</span></label>
                                            <input type="text" required value="{{old('business_name',$row->display_name)}}" placeholder="{{ __('Business Name')}}" name="business_name" class="form-control"  >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="" class="form-label">{{__("Store Avatar")}}</label>
                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Actions')}}</strong></div>
                            <div class="panel-body">
                                <div class="d-flex justify-content-between">
                                    <span></span>
                                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{ __('Save Change')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </section>
@endsection

@push('footer')
    <script src="{{theme_url('/Base/vendor/js/form.js')}}"></script>
@endpush
