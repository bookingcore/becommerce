<div class="checkout-form" data-select2-id="6">
    <h3 class="title">{{__('Billing Details')}}</h3>
    <div class="default-form" data-select2-id="5">
        <div class="row">
            <!--Form Group-->
            <div class="col-lg-6  mb-4">
                <label class="form-label">{{__('First name')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="first_name" value="{{old('first_name',$user->billing_first_name ? $user->billing_first_name : $user->first_name)}}" placeholder="">
            </div>
            <!--Form Group-->
            <div class=" col-lg-6  mb-4">
                <label class="form-label">{{__('Last name')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="last_name" value="{{old('last_name',$user->billing_last_name ? $user->billing_last_name : $user->last_name)}}" placeholder="">
            </div>
            <div class="col-sm-6  mb-4">
                <label class="form-label">
                    {{ __("Phone") }} <span class="text-danger">*</span>
                </label>
                <input type="email" class="form-control" placeholder="{{__("Your Phone")}}"  value="{{$user->phone ?? ''}}" name="phone">
            </div>
            <div class="col-sm-6 mb-4 ">
                <label class="form-label">
                    {{ __("Country") }}  <span class="text-danger">*</span>
                </label>
                <select name="country" class="form-control" >
                    <option value="">{{__('-- Select --')}}</option>
                    @foreach(get_country_lists() as $id=>$name)
                        <option @if(($user->country ?? '') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 mb-4">
                <label class="form-label">
                    {{ __("State/Province/Region") }}
                </label>
                <input type="text" class="form-control"  value="{{$user->state ?? ''}}" name="state" placeholder="{{__("State/Province/Region")}}">
            </div>
            <div class="col-sm-6 mb-4">
                <label class="form-label">
                    {{ __("City") }}
                </label>
                <input type="text" class="form-control"  value="{{$user->city ?? ''}}" name="city" placeholder="{{__("Your City")}}">
            </div>
            <div class="col-lg-6  mb-4">
                <div class="form-label">{{ __("Address 1") }} <span class="text-danger">*</span></div>
                <input type="text" class="form-control" value="{{$user->address ?? ''}}" name="address" placeholder="{{__('House number and street name')}}">
            </div>
            <div class="col-lg-6  mb-4">
                <div class="form-label">{{ __("Address 2") }}</div>
                <input type="text" class="form-control" value="{{$user->address2 ?? ''}}" name="address_line_2" placeholder="{{__('Apartment,suite,unit etc. (optional)')}}">
            </div>
            <div class="col-lg-6  mb-4">
                <label class="form-label">
                    {{ __("ZIP code/Postal code") }}  <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control"  value="{{$user->zip_code ?? ''}}" name="zip_code" placeholder="{{__("ZIP code/Postal code")}}">
            </div>
            <div class="w-100"></div>
        </div>
    </div>
</div>
