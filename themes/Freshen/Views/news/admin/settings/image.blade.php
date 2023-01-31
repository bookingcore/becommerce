@if(is_default_lang())
    <div class="form-group">
        <label>{{__("Header background")}}</label>
        <div class="form-controls form-group-image">
            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('news_page_image',setting_item('news_page_image')) !!}
        </div>
    </div>
@endif
