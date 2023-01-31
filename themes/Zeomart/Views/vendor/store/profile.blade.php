@extends('layouts.vendor')
@section('content')
    <section class="bc-items-listing">
        <div class="flex justify-between mb-16">
            <h1 class="text-3xl font-medium">{{$page_title ?? ''}}</h1>
        </div>
        <form action="{{ route('vendor.profile.store') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="container-fluid">
                @include('global.message')
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-md-9 col-span-9">
                        <div class="panel overflow-hidden">
                            <div class="panel-title"><strong>{{ __('Store Info')}}</strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="control-label">{{ __('Business Name')}} <span class="text-danger">*</span></label>
                                            <input type="text" required value="{{old('business_name',$row->display_name)}}" placeholder="{{ __('Business Name')}}" name="business_name" class="form-control"  >
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="" class="control-label">{{__("Store Avatar")}}</label>
                                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer rounded-bottom border-t">
                                <button class="btn btn-success bg-amber-300 hover:bg-amber-400 inline-flex items-center focus:ring-4 focus:ring-amber-200" type="submit"><i class="fa fa-save mr-2"></i> {{ __('Save Change')}}</button>
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
