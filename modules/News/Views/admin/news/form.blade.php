<div class="form-group">
    <label>{{ __('Title')}} <span class="text-danger">*</span></label>
    <input type="text" required value="{{ $translation->title ?? '' }}" placeholder="News title" name="title" class="form-control">
</div>
<div class="form-group">
    <label class="control-label">{{ __('Content')}} </label>
    <div class="">
        <textarea name="content" class="d-none has-tinymce" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>
