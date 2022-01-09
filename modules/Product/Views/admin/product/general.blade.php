<div class="form-group mb-3">
    <label>{{__("Name")}} <span class="text-danger">*</span></label>
    <div class="controls">
        <input type="text" required value="{{$translation->title}}" placeholder="{{__("Name of the product")}}" name="title" class="form-control">
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Content")}}</label>
    <div class="control">
        <textarea name="content" class="d-none has-tinymce" cols="30" rows="10">{{$translation->content}}</textarea>
    </div>
</div>
<div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Short Description")}}</label>
    <div class="control">
        <textarea name="short_desc" class="d-none has-tinymce" cols="30"  >{{$translation->short_desc}}</textarea>
    </div>
</div>
@if(is_default_lang())

    <div class="form-group mb-3">
    <label class="control-label mb-2">{{__("Feature Image")}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
    </div>
    <div class="form-group mb-3">
        <label class="control-label mb-2">{{__("Gallery")}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldGalleryUpload('gallery',$row->gallery) !!}
    </div>
    <div class="form-group mb-3">
        <label class="control-label mb-2">{{__("Status")}}</label>
        <div class="controls">
            <select name="status" class="custom-select form-select">
                <option value="publish">{{__("Publish")}}</option>
                <option @if($row->status=='pending') selected @endif value="pending">{{__("Pending")}}</option>
                <option @if($row->status=='draft') selected @endif value="draft">{{__("Draft")}}</option>
            </select>
        </div>
    </div>
    @if(is_admin() and !empty($is_admin_page))
    <div class="form-group mb-3">
        <label>{{__('Is Featured?')}}</label>
        <div class="controls">
            <label>
                    <input type="checkbox" name="is_featured" @if($row->is_featured) checked @endif value="1"> {{__("This is a featured product")}}
                </label>
        </div>
    </div>
    @endif
    @if(is_default_lang() and is_admin() and !empty($is_admin_page))
        <hr>
        <div class="form-group mb-3">
            <label >{{__("Author")}}</label>
            <?php
            $user = !empty($row->author_id) ? App\User::find($row->author_id) : false;
            \App\Helpers\AdminForm::select2('author_id', [
                'configs' => [
                    'ajax'        => [
                        'url' => url('/admin/module/user/getForSelect2'),
                        'dataType' => 'json'
                    ],
                    'allowClear'  => true,
                    'placeholder' => __('-- Select User --')
                ]
            ], !empty($user->id) ? [
                $user->id,
                $user->getDisplayName() . ' (#' . $user->id . ')'
            ] : false)
            ?>
        </div>
    @endif
@endif
