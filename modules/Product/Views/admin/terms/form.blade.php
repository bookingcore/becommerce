@if(!empty($attr))
    <input type="hidden" name="attr_id" value="{{$attr->id}}">
@endif
<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Term name")}}" name="name" class="form-control">
</div>
@if(!empty($attr))
    @switch($attr->display_type)
        @case('text')
        <div class="form-group">
            <label>{{__("Display value")}}</label>
            <input type="text" value="{{$translation->name}}" placeholder="{{__("Text")}}" name="content" class="form-control">
        </div>
        @break

        @case('color')
        <div class="form-group">
            <label>{{__("Display value")}}</label>
            <input type="color" value="{{$translation->name}}" placeholder="{{__("Color")}}" name="content" class="form-control">
        </div>
        @break

        @case('image')
        <div class="form-group">
            <label >{{__('Image')}}</label>
            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('content',$row->image_id) !!}
        </div>
        @break
    @endswitch
@else
    <div class="form-group">
        <label>{{__("Content")}}</label>
        <input type="{{ $row->display_type == 'color' ? 'color' : 'text' }}" value="{{$row->content}}" placeholder="{{__("Term content")}}" name="content" class="form-control">
    </div>
@endif

{{--@if(is_default_lang())
@endif--}}
{{--<div class="form-group">--}}
    {{--<label class="control-label">{{__("Description")}}</label>--}}
    {{--<div class="">--}}
        {{--<textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>--}}
    {{--</div>--}}
{{--</div>--}}
