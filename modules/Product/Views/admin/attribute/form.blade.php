<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Attribute name")}}" name="name" class="form-control">
    <hr/>
    <label>{{__("Type")}}</label>
    <select name="display_type" class="form-control">
        <option @if($row->display_type == 'text') selected @endif value="text">{{ __('Text') }}</option>
        <option @if($row->display_type == 'color') selected @endif value="color">{{ __('Color') }}</option>
        <option @if($row->display_type == 'image') selected @endif value="image">{{ __('Image') }}</option>
    </select>
</div>
