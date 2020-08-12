<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Brand name")}}" name="name" class="form-control">
</div>
@if(is_default_lang())
    <div class="form-group">
        <label >{{__('Feature Image')}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
    </div>
@endif
