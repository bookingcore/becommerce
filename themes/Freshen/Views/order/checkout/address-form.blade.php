<div class="row">
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label class="form-label">{{__('First name')}} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="{{$prefix}}first_name" required value="{{old($prefix.'first_name',$address->first_name ?? '')}}">
            <span class="input-error {{$prefix}}first_name"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label class="form-label">{{__('Last name')}} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="{{$prefix}}last_name" required value="{{old($prefix.'last_name',$address->last_name ?? '')}}">
            <span class="input-error {{$prefix}}last_name"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3">
            <label class="form-label">{{__('Company (optional)')}}</label>
            <input class="form-control" type="text" name="{{$prefix}}company" value="{{old($prefix.'company',$address->company ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3">
            <label  class="">{{__('Country / Region')}}&nbsp;<span class="text-danger" title="required">*</span></label>
            <div class="">
                <select class="form-control bc-select2" name="{{$prefix}}country">
                    <option value="">{{__("Please select")}}</option>
                    @foreach(get_country_lists() as $key => $country)
                        <option value="{{$key}}" @if($key == old($prefix.'country',$address->country ?? '')) selected @endif>{{$country}}</option>
                    @endforeach
                </select>
            </div>
            <span class="input-error {{$prefix}}country"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3 ">
            <label class="">
                {{__('Street address')}}&nbsp;<span class="text-danger" title="required">*</span>
            </label>
            <input type="text" class="form-control " name="{{$prefix}}address" placeholder="{{__('House number and street name')}}" value="{{old($prefix.'address',$address->address ?? '')}}">
            <span class="input-error {{$prefix}}address"></span>
            <input type="text" class="form-control mt-3 " name="{{$prefix}}address2" placeholder="{{__('Apartment, suite, unit, etc. (optional)')}}" value="{{old($prefix.'address2',$address->address2 ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3 ">
            <label class="">
                {{__('Postcode / ZIP (optional)')}}
            </label>
            <input type="text" class="form-control " name="{{$prefix}}postcode"  value="{{old($prefix.'postcode',$address->postcode ?? '')}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label class="form-label">{{__('City')}} <span class="text-danger">*</span></label>
            <input class="form-control" type="text" name="{{$prefix}}city" required value="{{old($prefix.'city',$address->city ?? '')}}">
            <span class="input-error {{$prefix}}city"></span>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-3">
            <label class="form-label">{{__('State (optional)')}}</label>
            <input class="form-control" type="text" name="{{$prefix}}state" value="{{old($prefix.'state',$address->state ?? '')}}">
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3 ">
            <label class="form-label">
                {{__('Phone')}} <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control " name="{{$prefix}}phone" required  value="{{old($prefix.'phone',$address->phone ?? '')}}">
            <span class="input-error {{$prefix}}phone"></span>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group mb-3 ">
            <label class="form-label">
                {{__('Email')}} <span class="text-danger">*</span>
            </label>
            <input type="email" class="form-control" name="{{$prefix}}email" required  value="{{old($prefix.'email',$address->email ?? '')}}">
            <span class="input-error {{$prefix}}email"></span>
        </div>
    </div>
</div>
