<div class="form-group mb-3">
    <label class="control-label">{{__("Name")}} <span class="text-danger">*</span></label>
    <div class="controls">
        <input type="text" required value="{{$translation->title}}" placeholder="{{__("Name of the product")}}" name="title" class="form-control">
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Description")}}</label>
    <div class="control">
        <textarea name="content" class="d-none has-tinymce" cols="30" rows="10">{{old('content',$translation->content)}}</textarea>
    </div>
</div>
