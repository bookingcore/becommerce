<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("What you'll learn")}}</label>
    <div class="controls">
        <textarea name="learn"  cols="30" rows="10" class="form-control has-tinymce">{{old('learn',$product->learn)}}</textarea>
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Requirements")}}</label>
    <div class="controls">
        <textarea name="requirements"  cols="30" rows="10" class="form-control has-tinymce">{{old('requirements',$product->requirements)}}</textarea>
    </div>
</div>
