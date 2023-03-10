@extends('admin.layouts.app')

@section('content')
    <form action="{{url('admin/module/user/store/'.($row->id ?? -1))}}" method="post" class="needs-validation" novalidate>
        <input type="hidden" name="user_type" value="{{ request()->get("user_type",$user_type ?? '') }}">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit: '.$row->display_name : 'Add new'}}</h1>
                </div>
            </div>
            @include('admin.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('User Info')}}</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('E-mail')}} <span class="text-danger">*</span></label>
                                        <input type="email" required value="{{old('email',$row->email)}}" placeholder="{{ __('Email')}}" name="email" class="form-control"  >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("First name")}} <span class="text-danger">*</span></label>
                                        <input type="text" required value="{{old('first_name',$row->first_name)}}" name="first_name" placeholder="{{__("First name")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Last name")}} <span class="text-danger">*</span></label>
                                        <input type="text" required value="{{old('last_name',$row->last_name)}}" name="last_name" placeholder="{{__("Last name")}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__("Display name")}} <span class="text-danger">*</span></label>
                                        <input type="text" required value="{{old('business_name',$row->display_name)}}" name="business_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Phone Number')}}</label>
                                        <input type="text" value="{{old('phone',$row->phone)}}" placeholder="{{ __('Phone')}}" name="phone" class="form-control"   >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Birthday')}}</label>
                                        <input type="text" readonly style="background: white" value="{{ old('birthday',$row->birthday ? date("Y/m/d",strtotime($row->birthday)) :'') }}" placeholder="{{ __('Birthday')}}" name="birthday" class="form-control has-datepicker input-group date">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ __('Biographical')}}</label>
                                <div class="">
                                    <textarea name="bio" class="d-none has-tinymce" cols="30" rows="10">{{old('bio',$row->bio)}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Publish')}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>{{__('Status')}} <span class="text-danger">*</span></label>
                                <select required class="custom-select" name="status">
                                    <option @if(old('status',$row->status) =='publish') selected @endif value="publish">{{ __('Publish')}}</option>
                                    <option @if(old('status',$row->status) =='blocked') selected @endif value="blocked">{{ __('Blocked')}}</option>
                                </select>
                            </div>
                            @if(is_admin())
                                @if(empty($user_type) or $user_type != 'vendor')
                                    <div class="form-group">
                                        <label>{{__('Role')}} <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="role_id">
                                            <option value="">{{ __('-- Select --')}}</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @if(old('role_id',$row->role_id) == $role->id) selected @elseif(old('role_id')  == $role->id ) selected @elseif(request()->input("user_type")  == strtolower($role->name) ) selected @endif >{{ucfirst($role->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            <div class="form-group">
                                <label>{{__('Email Verified?')}}</label>
                                <select  class="form-control" name="is_email_verified">
                                    <option value="">{{ __('No')}}</option>
                                    <option @if(old('is_email_verified',$row->email_verified_at ? 1 : 0)) selected @endif value="1">{{__('Yes')}}</option>
                                </select>
                            </div>
                            @endif
                            <div class="d-flex justify-content-between">
                                <span></span>
                                <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                            </div>
                        </div>
                    </div>
                    @if(empty($user_type) or $user_type == 'vendor')
                    <input type="hidden" name="is_vendor_form" value="1">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('For Vendor')}}</strong></div>
                        <div class="panel-body">
                            <?php $meta = $row->getMeta('vendor_mode') ?>
                            <div class="form-group">
                                <label >{{__("Vendor Mode")}}</label>
                                <select name="vendor_mode" class="form-control">
                                    <option value="">{{__("-- Global Option --")}}</option>
                                    <option value="both" @if($meta == 'both') selected @endif>{{__("Vendor can add brand new AND sell exist product")}}</option>
                                    <option value="only_new" @if($meta == 'only_new') selected @endif>{{__('Only allow add new')}}</option>
                                    <option value="only_exists" @if($meta == 'only_exists') selected @endif>{{__('Only allow sell exist product')}}</option>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>{{ __('Commission Type')}}</label>
                                <select class="form-control" name="commission_type">
                                    <option value="default">{{__("-- [Default role config] -- ")}}</option>
                                    <option value="percent" @if($row->commission_type == 'percent') selected @endif > {{__("Percent")}}</option>
                                    <option value="amount" @if($row->commission_type == 'amount') selected @endif >{{__("Amount")}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{ __('Commission')}}</label>
                                <input type="number" value="{{$row->commission}}" placeholder="{{ __('Commission')}}" name="commission" class="form-control">
                            </div>
                        </div>
                    </div>
                    @endif
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
        </div>
    </form>

@endsection
