@php
    $user = auth()->user();
    $has_user = ($user) ? true : false;
    $shipping = (!empty(session('shipping'))) ? session('shipping') : null;
@endphp
<div id="customer_details">
    <div class="checkout-billing">
        <div class="billing-fields">
            <h3>{{ __('Billing details') }}</h3>
            <div class="billing-fields__field-wrapper">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="billing_first_name" class="">
                                {{ __('First name') }}&nbsp;<abbr class="required" title="required">*</abbr>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control" name="billing_first_name" id="billing_first_name" placeholder="" value="{{ $has_user ? $user->first_name : '' }}" autocomplete="given-name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="billing_last_name" class="">
                                {{ __('Last name') }}&nbsp;<abbr class="required" title="required">*</abbr>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control " name="billing_last_name" id="billing_last_name" placeholder="" value="{{ $has_user ? $user->last_name : '' }}" autocomplete="family-name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="billing_email">
                            <label for="billing_email" class="">
                                {{ __('Email') }}&nbsp;<abbr class="required" title="required">*</abbr>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control " name="billing_email" id="billing_email" placeholder="" value="{{$has_user ? $user->email : ''}}" autocomplete="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group validate-required validate-phone" id="billing_phone_field" data-priority="100">
                            <label for="billing_phone" class="">{{__('Phone')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div class="input-wrapper"><input type="tel" class="form-control " name="billing_phone" id="billing_phone" placeholder="" value="{{$user->phone ?? ''}}" autocomplete="tel"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="billing_company_field">
                    <label for="billing_company" class="">
                        {{ __('Company name') }}&nbsp;<span class="optional">{{ __('(optional)') }}</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" class="form-control " name="billing_company" id="billing_company" placeholder="" value="" autocomplete="organization">
                    </div>
                </div>

                <div class="form-group address-field update_totals_on_change validate-required" id="billing_country_field">
                    <label for="billing_country" class="">{{__('Country / Region')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                    <div class="">
                        <select class="form-control" name="country">
                            @foreach(get_country_lists() as $key => $country)
                                <option value="{{$key}}" {{$shipping['country']['key'] == $key ? 'selected' : ''}}>{{$country}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group address-field validate-required" id="billing_address_1_field">
                    <label for="billing_address_1" class="">
                        {{__('Street address')}}&nbsp;<abbr class="required" title="required">*</abbr>
                    </label>
                    <span class="input-wrapper">
                        <input type="text" class="form-control " name="billing_address_1" placeholder="{{__('House number and street name')}}" value="{{$user->address}}" autocomplete="address-line1">
                    </span>
                </div>

                <div class="form-group address-field" id="billing_address_2_field" data-priority="60">
                    <label for="billing_address_2" class="screen-reader-text">
                        {{__('Apartment, suite, unit, etc. (optional)')}}&nbsp;
                        <span class="optional">({{__('optional')}})</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" class="form-control " name="billing_address_2" placeholder="{{__('Apartment, suite, unit, etc. (optional)')}}" value="{{$user->address2}}" autocomplete="address-line2" >
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group address-field validate-required" id="billing_city_field" data-priority="70" data-o_class="form-group address-field validate-required">
                            <label for="billing_city" class="">{{__('Town/City')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control " name="billing_city" id="billing_city" placeholder="" value="{{$user->city ?? ''}}" autocomplete="address-level2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group address-field validate-required validate-postcode" id="billing_postcode_field" data-priority="90" data-o_class="form-group address-field validate-required validate-postcode">
                            <label for="billing_postcode" class="">{{__('Postcode')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div class="input-wrapper"><input type="text" class="form-control " name="billing_postcode" id="billing_postcode" placeholder="" value="{{$user->postcode ?? ''}}" autocomplete="postal-code"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!auth()->check())
        <div class="account-fields">
            <p class="form-group create-account validated">
                <label class="form__label form__label-for-checkbox checkbox">
                    <input class="form__input form__input-checkbox input-checkbox"
                           id="createaccount" type="checkbox" name="createaccount" v-model="createaccount" value="1">
                    <span>{{__('Create an account?')}}</span>
                </label>
            </p>


            <div class="create-account mb-5" v-show="createaccount">
                <div class=" validate-required" id="account_password_field" data-priority=""><label
                        for="account_password" class="">{{__('Create account password')}}&nbsp;<abbr class="required"
                                                                                           title="required">*</abbr></label>
                    <div
                        class="input-wrapper"><input type="password" class="form-control "
                                                                 name="account_password" id="account_password"
                                                                 placeholder="{{__('Password')}}" value="">
                    </div>
                </div>
            </div>


        </div>
        @endif
    </div>

    <div class="checkout-shipping">
        <div class="shipping-fields">

            <h3 id="ship-to-different-address">
                <label class="form__label form__label-for-checkbox checkbox">
                    <input id="ship-to-different-address-checkbox"
                           class="form__input form__input-checkbox input-checkbox"
                           type="checkbox" v-model="ship_to_different_address" name="ship_to_different_address" value="1"> <span>{{__('Ship to a different address?')}}</span>
                </label>
            </h3>

            <div class="shipping_address" v-show="ship_to_different_address">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{__('First name')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div>
                                <input type="text" class="form-control "
                                       name="shipping_first_name" id="shipping_first_name"
                                       placeholder="" value="{{$user->shipping_first_name ?? ''}}" autocomplete="given-name">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label >{{__('Last name')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div>
                                <input type="text" class="form-control "
                                       name="shipping_last_name" id="shipping_last_name"
                                       placeholder="" value="{{$user->shipping_last_name ?? ''}}" autocomplete="last-name">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="shipping_company_field">
                    <label for="shipping_company" class="">
                        {{ __('Company name') }}&nbsp;<span class="optional">{{ __('(optional)') }}</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" class="form-control " name="shipping_company" id="shipping_company" placeholder="" value="{{$user->shipping_company ?? ''}}" autocomplete="organization">
                    </div>
                </div>

                <div class="form-group address-field update_totals_on_change validate-required" id="shipping_country_field">
                    <label for="shipping_country" class="">{{__('Country / Region')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                    <div class="">
                        <select class="form-control" name="shipping_country">
                            @foreach(get_country_lists() as $key => $country)
                                <option value="{{$key}}" {{$shipping['country']['key'] == $key ? 'selected' : ''}}>{{$country}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group address-field validate-required" id="shipping_address_1_field">
                    <label for="shipping_address_1" class="">
                        {{__('Street address')}}&nbsp;<abbr class="required" title="required">*</abbr>
                    </label>
                    <span class="input-wrapper">
                        <input type="text" class="form-control " name="shipping_address_1" placeholder="{{__('House number and street name')}}" value="{{$user->shipping_address_1}}" autocomplete="address-line1">
                    </span>
                </div>

                <div class="form-group address-field" id="shipping_address_2_field" data-priority="60">
                    <label for="shipping_address_2" class="screen-reader-text">
                        {{__('Apartment, suite, unit, etc. (optional)')}}&nbsp;
                        <span class="optional">({{__('optional')}})</span>
                    </label>
                    <div class="input-wrapper">
                        <input type="text" class="form-control " name="shipping_address_2" placeholder="{{__('Apartment, suite, unit, etc. (optional)')}}" value="{{$user->shipping_address_2}}" autocomplete="address-line2" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group address-field validate-required" id="shipping_city_field" data-priority="70" data-o_class="form-group address-field validate-required">
                            <label for="shipping_city" class="">{{__('Town/City')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div class="input-wrapper">
                                <input type="text" class="form-control " name="shipping_city" id="shipping_city" placeholder="" value="{{$user->shipping_city ?? ''}}" autocomplete="address-level2">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group address-field validate-required validate-postcode" id="shipping_postcode_field" data-priority="90" data-o_class="form-group address-field validate-required validate-postcode">
                            <label for="shipping_postcode" class="">{{__('Postcode')}}&nbsp;<abbr class="required" title="required">*</abbr></label>
                            <div class="input-wrapper"><input type="text" class="form-control " name="shipping_postcode" id="shipping_postcode" placeholder="" value="{{$user->shipping_postcode ?? ''}}" autocomplete="postal-code"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="notes" id="order_comments_field" data-priority="">
            <label for="customer_notes" class="">{{__('Order notes')}}&nbsp;<span class="optional">({{__('optional')}})</span></label>
            <div class="input-wrapper">
                <textarea name="customer_notes" class="form-control " id="customer_notes" placeholder="{{__('Notes about your order, e.g. special notes for delivery.')}}" rows="8" cols="5"></textarea>
            </div>
        </div>
    </div>
</div>
