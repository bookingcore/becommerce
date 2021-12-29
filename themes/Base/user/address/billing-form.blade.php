<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>{{__('First name')}} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="first_name" required value="{{old('first_name',$address->first_name ?? '')}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>{{__('Last name')}} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="last_name" required value="{{old('last_name',$address->last_name ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label>{{__('Company (optional)')}}</label>
            <input class="form-control" type="text" name="company" value="{{old('company',$address->company ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label  class="">{{__('Country / Region')}}&nbsp;<span class="text-danger" title="required">*</span></label>
            <div class="">
                <select class="form-control ps-select2" name="country">
                    @foreach(get_country_lists() as $key => $country)
                        <option value="{{$key}}" @if($key == old('country',$address->country ?? '')) selected @endif>{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group ">
            <label class="">
                {{__('Street address')}}&nbsp;<span class="text-danger" title="required">*</span>
            </label>
            <input type="text" class="form-control " name="address" placeholder="{{__('House number and street name')}}" value="{{old('address',$address->address ?? '')}}">
            <input type="text" class="form-control mt-3 " name="address2" placeholder="{{__('Apartment, suite, unit, etc. (optional)')}}" value="{{old('address2',$address->address2 ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group ">
            <label class="">
                {{__('Postcode / ZIP (optional)')}}
            </label>
            <input type="text" class="form-control " name="postcode"  value="{{old('postcode',$address->postcode ?? '')}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>{{__('City')}} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="city" required value="{{old('city',$address->city ?? '')}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>{{__('State (optional)')}}</label>
            <input class="form-control" type="text" name="state" value="{{old('state',$address->state ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group ">
            <label class="">
                {{__('Phone')}} <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control " name="phone" required  value="{{old('phone',$address->phone ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group ">
            <label class="">
                {{__('Email')}} <span class="text-danger">*</span>
            </label>
            <input type="email" class="form-control" name="email" required  value="{{old('email',$address->email ?? '')}}">
        </div>
    </div>
</div>
