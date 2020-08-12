<div class="form-group">
    <label>{{__("Name")}}</label>
    <input type="text" value="{{$translation->name}}" placeholder="{{__("Attribute name")}}" name="name" class="form-control">
    <hr/>
    <label>{{__("Type")}}</label>
    <input type="text" value="{{ $row->display_type }}" placeholder="{{__("Attribute type")}}" name="display_type" class="form-control">
</div>
