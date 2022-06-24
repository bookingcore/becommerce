<div class="form-group">
    <label>{{ __('Name')}} <span class="text-danger">*</span></label>
    <input type="text" required value="{{$translation->name}}" placeholder=" {{ __('Tag name')}}" name="name" class="form-control">
</div>
@if(is_default_lang())
<div class="form-group">
    <label>{{ __('Slug (Optional)')}}</label>
    <input type="text" value="{{$row->slug}}" placeholder=" {{ __('Tag Slug')}}" name="slug" class="form-control">
</div>
@endif
