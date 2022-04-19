<div class="form-group">
    <label>{{__("Name")}} <span class="text-danger">*</span></label>
    <input type="text" required value="{{old('name',$row->name)}}" placeholder="{{__("name")}}" name="name" class="form-control">
</div>
<div class="form-group">
    <label>{{__("Start Date")}} <span class="text-danger">*</span></label>
    <input type="text" required autocomplete="off" value="{{old('start_date',$row->start_date ? $row->start_date->format('Y/m/d') : '')}}"   placeholder="YYYY/MM/DD" name="start_date" class="form-control has-datepicker" style="background: white">
</div>
<div class="form-group">
    <label>{{__("End Date")}} <span class="text-danger">*</span></label>
    <input type="text" required autocomplete="off" value="{{old('end_date',$row->end_date ? $row->end_date->format('Y/m/d') : '')}}"  placeholder="YYYY/MM/DD" name="end_date" class="form-control  has-datepicker" style="background: white">
</div>
<div class="form-group">
    <label>{{__("Discount Amount (percent)")}} <span class="text-danger">*</span></label>
    <input type="number" required step="any" max="100" value="{{old('discount_amount',$row->discount_amount)}}"  name="discount_amount" class="form-control">
</div>
<div class="form-group">
    <label>{{__("Status")}}</label>
    <select class="form-control" name="status">
        <option value="">{{__("Draft")}}</option>
        <option @if(old('status',$row->status) == 'publish') selected @endif value="publish">{{__("Publish")}}</option>
    </select>
</div>

