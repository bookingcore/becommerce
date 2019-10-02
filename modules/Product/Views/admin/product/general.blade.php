<div class="form-group">
    <label>{{__("Title")}}</label>
    <div class="controls">
        <input type="text" value="{{$translation->title}}" placeholder="{{__("Name of the product")}}" name="title" class="form-control">
    </div>
</div>
<div class="form-group">
    <label class="control-label">{{__("Description")}}</label>
    <div class="control">
        <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
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
            <div>
                <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                </label>
            </div>
            <div>
                <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                </label>
            </div>
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