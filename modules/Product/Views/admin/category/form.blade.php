<div class="form-group">
    <label>{{__("Name")}} <span class="text-danger">*</span></label>
    <input type="text" required value="{{$translation->name}}" placeholder="{{__("Category name")}}" name="name" class="form-control">
</div>
@if(is_default_lang())
    <div class="form-group">
        <label>{{__("Parent")}}</label>
        <select name="parent_id" class="form-control">
            <option value="">{{__("-- Please Select --")}}</option>
            <?php
            $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                foreach ($categories as $category) {
                    if ($category->id == $row->id) {
                        continue;
                    }
                    $selected = '';
                    if ($row->parent_id == $category->id)
                        $selected = 'selected';
                    printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                    $traverse($category->children, $prefix . '-');
                }
            };
            $traverse($parents);
            ?>
        </select>
    </div>
    <div class="form-group">
        <label >{{__('Feature Image')}}</label>
        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
    </div>
@endif
