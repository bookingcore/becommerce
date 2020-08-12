<div class="form-group">
    <label>{{__("Name")}}</label>
    <div class="controls">
        <input type="text" value="{{$translation->title}}" placeholder="{{__("Name of the product")}}" name="title" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{__("Content")}}</label>
    <div class="control">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{__("Short Description")}}</label>
    <div class="control">
        <textarea name="short_desc" class="d-none has-ckeditor" cols="30"  >{{$translation->short_desc}}</textarea>
    </div>
</div>
@if(is_default_lang())

    <div class="form-group">
    <label class="control-label">{{__("Feature Image")}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
    </div>
    <div class="form-group">
        <label class="control-label">{{__("Gallery")}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
    </div>
    <div class="form-group">
        <label class="control-label">{{__("Status")}}</label>
        <div class="controls">
            <select name="status" class="custom-select">
                <option value="publish">{{__("Publish")}}</option>
                <option @if($row->status=='pending') selected @endif value="pending">{{__("Pending")}}</option>
                <option @if($row->status=='draft') selected @endif value="draft">{{__("Draft")}}</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>{{__('Is Featured?')}}</label>
        <div class="controls">
            <label>
                    <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("This is a featured product")}}
                </label>
        </div>
    </div>
@endif
