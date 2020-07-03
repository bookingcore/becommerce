<div id="customer_details">
    <div class="checkout-billing">
        <div class="woocommerce-billing-fields">
            <h3>{{ __('Billing details') }}</h3>
            <div class="woocommerce-billing-fields__field-wrapper">
                <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="10">
                    <label for="billing_first_name" class="">
                        First name&nbsp;<abbr class="required" title="required">*</abbr>
                    </label>
                    <span class="woocommerce-input-wrapper">
                        <input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" value="" autocomplete="given-name">
                    </span>
                </p>

                <p class="form-row form-row-last validate-required" id="billing_last_name_field" data-priority="20">
                    <label for="billing_last_name" class="">Last name&nbsp;<abbr class="required" title="required">*</abbr></label>
                    <span class="woocommerce-input-wrapper">
                        <input type="text" class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" value="" autocomplete="family-name">
                    </span>
                </p>
                <p class="form-row form-row-wide" id="billing_company_field" data-priority="30">
                    <label for="billing_company" class="">Company name&nbsp;<span class="optional">(optional)</span></label>
                    <span class="woocommerce-input-wrapper">
                        <input type="text" class="input-text " name="billing_company" id="billing_company" placeholder="" value="" autocomplete="organization">
                    </span>
                </p>

                <p class="form-row form-row-wide address-field update_totals_on_change validate-required" id="billing_country_field" data-priority="40">
                    <label for="billing_country" class="">Country / Region&nbsp;<abbr class="required" title="required">*</abbr></label>
                    <span class="woocommerce-input-wrapper">
                        <select name="billing_country" id="billing_country" class="country_to_state country_select select2-hidden-accessible" autocomplete="country" tabindex="-1" aria-hidden="true">
                            <option value="">Select a country / region…</option><option
                                value="AX">Åland Islands</option><option value="AF">Afghanistan</option><option
                                value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option
                                value="AD">Andorra</option><option value="AO">Angola</option><option
                                value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option
                                value="AR">Argentina</option><option value="AM">Armenia</option><option
                                value="AW">Aruba</option><option value="AU" selected="selected">Australia</option><option
                                value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option
                                value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option
                                value="BY">Belarus</option><option value="PW">Belau</option><option
                                value="BE">Belgium</option><option value="BZ">Belize</option><option
                                value="BJ">Benin</option><option value="BM">Bermuda</option><option
                                value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BQ">Bonaire, Saint Eustatius and Saba</option><option
                                value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option
                                value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option
                                value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option
                                value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option
                                value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option
                                value="CF">Central African Republic</option><option value="TD">Chad</option><option
                                value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option
                                value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option
                                value="KM">Comoros</option><option value="CG">Congo (Brazzaville)</option><option
                                value="CD">Congo (Kinshasa)</option><option value="CK">Cook Islands</option><option
                                value="CR">Costa Rica</option><option value="HR">Croatia</option><option
                                value="CU">Cuba</option><option value="CW">Curaçao</option><option
                                value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option
                                value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option
                                value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option
                                value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option
                                value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands</option><option
                                value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option
                                value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option
                                value="TF">French Southern Territories</option><option value="GA">Gabon</option><option
                                value="GM">Gambia</option><option value="GE">Georgia</option><option
                                value="DE">Germany</option><option value="GH">Ghana</option><option
                                value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option
                                value="GD">Grenada</option><option value="GP">Guadeloupe</option><option
                                value="GU">Guam</option><option value="GT">Guatemala</option><option
                                value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option
                                value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option
                                value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option
                                value="IS">Iceland</option><option value="IN">India</option><option
                                value="ID">Indonesia</option><option value="IR">Iran</option><option
                                value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option
                                value="IL">Israel</option><option value="IT">Italy</option><option value="CI">Ivory Coast</option><option
                                value="JM">Jamaica</option><option value="JP">Japan</option><option
                                value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option
                                value="KE">Kenya</option><option value="KI">Kiribati</option><option
                                value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option
                                value="LA">Laos</option><option value="LV">Latvia</option><option
                                value="LB">Lebanon</option><option value="LS">Lesotho</option><option
                                value="LR">Liberia</option><option value="LY">Libya</option><option value="LI">Liechtenstein</option><option
                                value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao</option><option
                                value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option
                                value="MV">Maldives</option><option value="ML">Mali</option><option
                                value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option
                                value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option
                                value="MX">Mexico</option><option value="FM">Micronesia</option><option value="MD">Moldova</option><option
                                value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option
                                value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option
                                value="MM">Myanmar</option><option value="NA">Namibia</option><option
                                value="NR">Nauru</option><option value="NP">Nepal</option><option
                                value="NL">Netherlands</option><option value="NC">New Caledonia</option><option
                                value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option
                                value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option
                                value="KP">North Korea</option><option value="MK">North Macedonia</option><option
                                value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option
                                value="OM">Oman</option><option value="PK">Pakistan</option><option value="PS">Palestinian Territory</option><option
                                value="PA">Panama</option><option value="PG">Papua New Guinea</option><option
                                value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option
                                value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option
                                value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option
                                value="RO">Romania</option><option value="RU">Russia</option><option
                                value="RW">Rwanda</option><option value="ST">São Tomé and Príncipe</option><option
                                value="BL">Saint Barthélemy</option><option value="SH">Saint Helena</option><option
                                value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option
                                value="SX">Saint Martin (Dutch part)</option><option value="MF">Saint Martin (French part)</option><option
                                value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option
                                value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option
                                value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option
                                value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option
                                value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option
                                value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia/Sandwich Islands</option><option
                                value="KR">South Korea</option><option value="SS">South Sudan</option><option
                                value="ES">Spain</option><option value="LK">Sri Lanka</option><option
                                value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option
                                value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option
                                value="SY">Syria</option><option value="TW">Taiwan</option><option
                                value="TJ">Tajikistan</option><option value="TZ">Tanzania</option><option value="TH">Thailand</option><option
                                value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option
                                value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option
                                value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option
                                value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option
                                value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option
                                value="GB">United Kingdom (UK)</option><option value="US">United States (US)</option><option
                                value="UM">United States (US) Minor Outlying Islands</option><option
                                value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option
                                value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option
                                value="VG">Virgin Islands (British)</option><option
                                value="VI">Virgin Islands (US)</option><option value="WF">Wallis and Futuna</option><option
                                value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option
                                value="ZW">Zimbabwe
                            </option>
                        </select>
                        <span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;">
                            <span class="selection">
                                <span class="select2-selection select2-selection--single" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-billing_country-container" role="combobox">
                                    <span class="select2-selection__rendered" id="select2-billing_country-container" role="textbox" aria-readonly="true" title="Australia">Australia</span>
                                    <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                </span>
                            </span>
                            <span class="dropdown-wrapper" aria-hidden="true"></span>
                        </span>
                        <noscript>
                            <button
                                type="submit" name="woocommerce_checkout_update_totals" value="Update country / region">Update country / region</button></noscript></span>
                </p>
                <p class="form-row form-row-wide address-field validate-required" id="billing_address_1_field"
                   data-priority="50"><label for="billing_address_1" class="">Street address&nbsp;<abbr class="required"
                                                                                                        title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                 name="billing_address_1" id="billing_address_1"
                                                                 placeholder="House number and street name" value=""
                                                                 autocomplete="address-line1"
                                                                 data-placeholder="House number and street name"></span>
                </p>
                <p class="form-row form-row-wide address-field" id="billing_address_2_field" data-priority="60"><label
                        for="billing_address_2" class="screen-reader-text">Apartment, suite, unit, etc. (optional)&nbsp;<span
                            class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input
                            type="text" class="input-text " name="billing_address_2" id="billing_address_2"
                            placeholder="Apartment, suite, unit, etc. (optional)" value="" autocomplete="address-line2"
                            data-placeholder="Apartment, suite, unit, etc. (optional)"></span></p>
                <p class="form-row form-row-wide address-field validate-required" id="billing_city_field"
                   data-priority="70" data-o_class="form-row form-row-wide address-field validate-required"><label
                        for="billing_city" class="">Suburb&nbsp;<abbr class="required" title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_city"
                                                                 id="billing_city" placeholder="" value=""
                                                                 autocomplete="address-level2"></span></p>
                <p class="form-row form-row-wide address-field validate-required validate-state"
                   id="billing_state_field" data-priority="80"
                   data-o_class="form-row form-row-wide address-field validate-required validate-state"><label
                        for="billing_state" class="">State&nbsp;<abbr class="required" title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><select name="billing_state" id="billing_state"
                                                                  class="state_select select2-hidden-accessible"
                                                                  autocomplete="address-level1"
                                                                  data-placeholder="Select an option…"
                                                                  data-input-classes="" tabindex="-1"
                                                                  aria-hidden="true"><option
                                value="">Select an option…</option><option
                                value="ACT">Australian Capital Territory</option><option
                                value="NSW">New South Wales</option><option value="NT">Northern Territory</option><option
                                value="QLD">Queensland</option><option value="SA">South Australia</option><option
                                value="TAS">Tasmania</option><option value="VIC">Victoria</option><option value="WA">Western Australia</option></select><span
                            class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span
                                class="selection"><span class="select2-selection select2-selection--single"
                                                        aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                        aria-labelledby="select2-billing_state-container"
                                                        role="combobox"><span class="select2-selection__rendered"
                                                                              id="select2-billing_state-container"
                                                                              role="textbox" aria-readonly="true"
                                                                              title="South Australia">South Australia</span><span
                                        class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span
                                class="dropdown-wrapper" aria-hidden="true"></span></span></span></p>
                <p class="form-row form-row-wide address-field validate-required validate-postcode"
                   id="billing_postcode_field" data-priority="90"
                   data-o_class="form-row form-row-wide address-field validate-required validate-postcode"><label
                        for="billing_postcode" class="">Postcode&nbsp;<abbr class="required"
                                                                            title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><input type="text" class="input-text " name="billing_postcode"
                                                                 id="billing_postcode" placeholder="" value=""
                                                                 autocomplete="postal-code"></span></p>
                <p class="form-row form-row-wide validate-required validate-phone" id="billing_phone_field"
                   data-priority="100"><label for="billing_phone" class="">Phone&nbsp;<abbr class="required"
                                                                                            title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><input type="tel" class="input-text " name="billing_phone"
                                                                 id="billing_phone" placeholder="" value=""
                                                                 autocomplete="tel"></span></p>
                <p class="form-row form-row-wide validate-required validate-email" id="billing_email_field"
                   data-priority="110"><label for="billing_email" class="">Email address&nbsp;<abbr class="required"
                                                                                                    title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><input type="email" class="input-text " name="billing_email"
                                                                 id="billing_email" placeholder="" value=""
                                                                 autocomplete="email username"></span></p></div>

        </div>

        <div class="woocommerce-account-fields">

            <p class="form-row form-row-wide create-account woocommerce-validated">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                           id="createaccount" type="checkbox" name="createaccount" value="1">
                    <span>Create an account?</span>
                </label>
            </p>


            <div class="create-account" style="display: none;">
                <p class="form-row validate-required" id="account_password_field" data-priority=""><label
                        for="account_password" class="">Create account password&nbsp;<abbr class="required"
                                                                                           title="required">*</abbr></label><span
                        class="woocommerce-input-wrapper"><input type="password" class="input-text "
                                                                 name="account_password" id="account_password"
                                                                 placeholder="Password" value=""></span></p>
                <div class="clear"></div>
            </div>


        </div>
    </div>

    <div class="checkout-shipping">
        <div class="woocommerce-shipping-fields">

            <h3 id="ship-to-different-address">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input id="ship-to-different-address-checkbox"
                           class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                           type="checkbox" name="ship_to_different_address" value="1"> <span>Ship to a different address?</span>
                </label>
            </h3>

            <div class="shipping_address" style="display: none;">


                <div class="woocommerce-shipping-fields__field-wrapper">
                    <p class="form-row form-row-first validate-required" id="shipping_first_name_field"
                       data-priority="10"><label for="shipping_first_name" class="">First name&nbsp;<abbr
                                class="required" title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                     name="shipping_first_name" id="shipping_first_name"
                                                                     placeholder="" value="" autocomplete="given-name"></span>
                    </p>
                    <p class="form-row form-row-last validate-required" id="shipping_last_name_field"
                       data-priority="20"><label for="shipping_last_name" class="">Last name&nbsp;<abbr class="required"
                                                                                                        title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                     name="shipping_last_name" id="shipping_last_name"
                                                                     placeholder="" value="" autocomplete="family-name"></span>
                    </p>
                    <p class="form-row form-row-wide" id="shipping_company_field" data-priority="30"><label
                            for="shipping_company" class="">Company name&nbsp;<span
                                class="optional">(optional)</span></label><span class="woocommerce-input-wrapper"><input
                                type="text" class="input-text " name="shipping_company" id="shipping_company"
                                placeholder="" value="" autocomplete="organization"></span></p>
                    <p class="form-row form-row-wide address-field update_totals_on_change validate-required"
                       id="shipping_country_field" data-priority="40"><label for="shipping_country" class="">Country /
                            Region&nbsp;<abbr class="required" title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><select name="shipping_country" id="shipping_country"
                                                                      class="country_to_state country_select select2-hidden-accessible"
                                                                      autocomplete="country" tabindex="-1"
                                                                      aria-hidden="true"><option value="">Select a country / region…</option><option
                                    value="AX">Åland Islands</option><option value="AF">Afghanistan</option><option
                                    value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option
                                    value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option
                                    value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option
                                    value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option
                                    value="AU" selected="selected">Australia</option><option value="AT">Austria</option><option
                                    value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option
                                    value="BD">Bangladesh</option><option value="BB">Barbados</option><option
                                    value="BY">Belarus</option><option value="PW">Belau</option><option value="BE">Belgium</option><option
                                    value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option
                                    value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BQ">Bonaire, Saint Eustatius and Saba</option><option
                                    value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option
                                    value="BV">Bouvet Island</option><option value="BR">Brazil</option><option
                                    value="IO">British Indian Ocean Territory</option><option value="BN">Brunei</option><option
                                    value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option
                                    value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option
                                    value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option
                                    value="CF">Central African Republic</option><option value="TD">Chad</option><option
                                    value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option
                                    value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option
                                    value="KM">Comoros</option><option value="CG">Congo (Brazzaville)</option><option
                                    value="CD">Congo (Kinshasa)</option><option value="CK">Cook Islands</option><option
                                    value="CR">Costa Rica</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option
                                    value="CW">Curaçao</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option
                                    value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option
                                    value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option
                                    value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option
                                    value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option
                                    value="FK">Falkland Islands</option><option value="FO">Faroe Islands</option><option
                                    value="FJ">Fiji</option><option value="FI">Finland</option><option
                                    value="FR">France</option><option value="GF">French Guiana</option><option
                                    value="PF">French Polynesia</option><option
                                    value="TF">French Southern Territories</option><option value="GA">Gabon</option><option
                                    value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option
                                    value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option
                                    value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option
                                    value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option
                                    value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option
                                    value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option
                                    value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option
                                    value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option
                                    value="IR">Iran</option><option value="IQ">Iraq</option><option
                                    value="IE">Ireland</option><option value="IM">Isle of Man</option><option
                                    value="IL">Israel</option><option value="IT">Italy</option><option value="CI">Ivory Coast</option><option
                                    value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option
                                    value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option
                                    value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option
                                    value="LA">Laos</option><option value="LV">Latvia</option><option
                                    value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option
                                    value="LY">Libya</option><option value="LI">Liechtenstein</option><option
                                    value="LT">Lithuania</option><option value="LU">Luxembourg</option><option
                                    value="MO">Macao</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option
                                    value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option
                                    value="MT">Malta</option><option value="MH">Marshall Islands</option><option
                                    value="MQ">Martinique</option><option value="MR">Mauritania</option><option
                                    value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option
                                    value="FM">Micronesia</option><option value="MD">Moldova</option><option value="MC">Monaco</option><option
                                    value="MN">Mongolia</option><option value="ME">Montenegro</option><option
                                    value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option
                                    value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option
                                    value="NP">Nepal</option><option value="NL">Netherlands</option><option value="NC">New Caledonia</option><option
                                    value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option
                                    value="NE">Niger</option><option value="NG">Nigeria</option><option
                                    value="NU">Niue</option><option value="NF">Norfolk Island</option><option
                                    value="KP">North Korea</option><option value="MK">North Macedonia</option><option
                                    value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option
                                    value="OM">Oman</option><option value="PK">Pakistan</option><option value="PS">Palestinian Territory</option><option
                                    value="PA">Panama</option><option value="PG">Papua New Guinea</option><option
                                    value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option
                                    value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option
                                    value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option
                                    value="RO">Romania</option><option value="RU">Russia</option><option value="RW">Rwanda</option><option
                                    value="ST">São Tomé and Príncipe</option><option
                                    value="BL">Saint Barthélemy</option><option value="SH">Saint Helena</option><option
                                    value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option
                                    value="SX">Saint Martin (Dutch part)</option><option value="MF">Saint Martin (French part)</option><option
                                    value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option
                                    value="WS">Samoa</option><option value="SM">San Marino</option><option value="SA">Saudi Arabia</option><option
                                    value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option
                                    value="SL">Sierra Leone</option><option value="SG">Singapore</option><option
                                    value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option
                                    value="SO">Somalia</option><option value="ZA">South Africa</option><option
                                    value="GS">South Georgia/Sandwich Islands</option><option
                                    value="KR">South Korea</option><option value="SS">South Sudan</option><option
                                    value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option
                                    value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen</option><option
                                    value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option
                                    value="SY">Syria</option><option value="TW">Taiwan</option><option value="TJ">Tajikistan</option><option
                                    value="TZ">Tanzania</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option
                                    value="TG">Togo</option><option value="TK">Tokelau</option><option
                                    value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option
                                    value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option
                                    value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option
                                    value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option
                                    value="GB">United Kingdom (UK)</option><option
                                    value="US">United States (US)</option><option value="UM">United States (US) Minor Outlying Islands</option><option
                                    value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option
                                    value="VA">Vatican</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option
                                    value="VG">Virgin Islands (British)</option><option
                                    value="VI">Virgin Islands (US)</option><option value="WF">Wallis and Futuna</option><option
                                    value="EH">Western Sahara</option><option value="YE">Yemen</option><option
                                    value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select><span
                                class="select2 select2-container select2-container--default" dir="ltr"
                                style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" aria-haspopup="true"
                                        aria-expanded="false" tabindex="0"
                                        aria-labelledby="select2-shipping_country-container" role="combobox"><span
                                            class="select2-selection__rendered" id="select2-shipping_country-container"
                                            role="textbox" aria-readonly="true" title="Australia">Australia</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span><noscript><button
                                    type="submit" name="woocommerce_checkout_update_totals"
                                    value="Update country / region">Update country / region</button></noscript></span>
                    </p>
                    <p class="form-row form-row-wide address-field validate-required" id="shipping_address_1_field"
                       data-priority="50"><label for="shipping_address_1" class="">Street address&nbsp;<abbr
                                class="required" title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                     name="shipping_address_1" id="shipping_address_1"
                                                                     placeholder="House number and street name" value=""
                                                                     autocomplete="address-line1"
                                                                     data-placeholder="House number and street name"></span>
                    </p>
                    <p class="form-row form-row-wide address-field" id="shipping_address_2_field" data-priority="60">
                        <label for="shipping_address_2" class="screen-reader-text">Apartment, suite, unit, etc.
                            (optional)&nbsp;<span class="optional">(optional)</span></label><span
                            class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                     name="shipping_address_2" id="shipping_address_2"
                                                                     placeholder="Apartment, suite, unit, etc. (optional)"
                                                                     value="" autocomplete="address-line2"
                                                                     data-placeholder="Apartment, suite, unit, etc. (optional)"></span>
                    </p>
                    <p class="form-row form-row-wide address-field validate-required" id="shipping_city_field"
                       data-priority="70" data-o_class="form-row form-row-wide address-field validate-required"><label
                            for="shipping_city" class="">Suburb&nbsp;<abbr class="required"
                                                                           title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                     name="shipping_city" id="shipping_city"
                                                                     placeholder="" value=""
                                                                     autocomplete="address-level2"></span></p>
                    <p class="form-row form-row-wide address-field validate-required validate-state"
                       id="shipping_state_field" data-priority="80"
                       data-o_class="form-row form-row-wide address-field validate-required validate-state"><label
                            for="shipping_state" class="">State&nbsp;<abbr class="required"
                                                                           title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><select name="shipping_state" id="shipping_state"
                                                                      class="state_select select2-hidden-accessible"
                                                                      autocomplete="address-level1"
                                                                      data-placeholder="Select an option…"
                                                                      data-input-classes="" tabindex="-1"
                                                                      aria-hidden="true"><option value="">Select an option…</option><option
                                    value="ACT">Australian Capital Territory</option><option
                                    value="NSW">New South Wales</option><option value="NT">Northern Territory</option><option
                                    value="QLD">Queensland</option><option value="SA">South Australia</option><option
                                    value="TAS">Tasmania</option><option value="VIC">Victoria</option><option
                                    value="WA">Western Australia</option></select><span
                                class="select2 select2-container select2-container--default" dir="ltr"
                                style="width: 100%;"><span class="selection"><span
                                        class="select2-selection select2-selection--single" aria-haspopup="true"
                                        aria-expanded="false" tabindex="0"
                                        aria-labelledby="select2-shipping_state-container" role="combobox"><span
                                            class="select2-selection__rendered" id="select2-shipping_state-container"
                                            role="textbox" aria-readonly="true"
                                            title="South Australia">South Australia</span><span
                                            class="select2-selection__arrow" role="presentation"><b
                                                role="presentation"></b></span></span></span><span
                                    class="dropdown-wrapper" aria-hidden="true"></span></span></span></p>
                    <p class="form-row form-row-wide address-field validate-required validate-postcode"
                       id="shipping_postcode_field" data-priority="90"
                       data-o_class="form-row form-row-wide address-field validate-required validate-postcode"><label
                            for="shipping_postcode" class="">Postcode&nbsp;<abbr class="required"
                                                                                 title="required">*</abbr></label><span
                            class="woocommerce-input-wrapper"><input type="text" class="input-text "
                                                                     name="shipping_postcode" id="shipping_postcode"
                                                                     placeholder="" value="" autocomplete="postal-code"></span>
                    </p></div>


            </div>

        </div>
        <div class="woocommerce-additional-fields">


            <div class="woocommerce-additional-fields__field-wrapper">
                <p class="form-row notes" id="order_comments_field" data-priority=""><label for="order_comments"
                                                                                            class="">Order
                        notes&nbsp;<span class="optional">(optional)</span></label><span
                        class="woocommerce-input-wrapper"><textarea name="order_comments" class="input-text "
                                                                    id="order_comments"
                                                                    placeholder="Notes about your order, e.g. special notes for delivery."
                                                                    rows="2" cols="5"></textarea></span></p></div>


        </div>
    </div>
</div>

{{--<div class="form-checkout" id="form-checkout" >
    <div class="form-section">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{__("First Name")}} <span class="required">*</span></label>
                    <input type="text" placeholder="{{__("First Name")}}" class="form-control" value="{{$user->first_name ?? ''}}" name="first_name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{__("Last Name")}} <span class="required">*</span></label>
                    <input type="text" placeholder="{{__("Last Name")}}" class="form-control" value="{{$user->last_name ?? ''}}" name="last_name">
                </div>
            </div>
            <div class="col-md-6 field-email">
                <div class="form-group">
                    <label >{{__("Email")}} <span class="required">*</span></label>
                    <input type="email" placeholder="{{__("email@domain.com")}}" class="form-control" value="{{$user->email ?? ''}}" name="email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label >{{__("Phone")}} <span class="required">*</span></label>
                    <input type="email" placeholder="{{__("Your Phone")}}" class="form-control" value="{{$user->phone ?? ''}}" name="phone">
                </div>
            </div>
            <div class="col-md-6 field-address-line-1">
                <div class="form-group">
                    <label >{{__("Address line 1")}} </label>
                    <input type="text" placeholder="{{__("Address line 1")}}" class="form-control" value="{{$user->address ?? ''}}" name="address_line_1">
                </div>
            </div>
            <div class="col-md-6 field-address-line-2">
                <div class="form-group">
                    <label >{{__("Address line 2")}} </label>
                    <input type="text" placeholder="{{__("Address line 2")}}" class="form-control" value="{{$user->address2 ?? ''}}" name="address_line_2">
                </div>
            </div>
            <div class="col-md-6 field-city">
                <div class="form-group">
                    <label >{{__("City")}} </label>
                    <input type="text" class="form-control" value="{{$user->city ?? ''}}" name="city" placeholder="{{__("Your City")}}">
                </div>
            </div>
            <div class="col-md-6 field-state">
                <div class="form-group">
                    <label >{{__("State/Province/Region")}} </label>
                    <input type="text" class="form-control" value="{{$user->state ?? ''}}" name="state" placeholder="{{__("State/Province/Region")}}">
                </div>
            </div>
            <div class="col-md-6 field-zip-code">
                <div class="form-group">
                    <label >{{__("ZIP code/Postal code")}} </label>
                    <input type="text" class="form-control" value="{{$user->zip_code ?? ''}}" name="zip_code" placeholder="{{__("ZIP code/Postal code")}}">
                </div>
            </div>
            <div class="col-md-6 field-country">
                <div class="form-group">
                    <label >{{__("Country")}} </label>
                    <select name="country" class="form-control">
                        <option value="">{{__('-- Select --')}}</option>
                        @foreach(get_country_lists() as $id=>$name)
                            <option @if(($user->country ?? '') == $id) selected @endif value="{{$id}}">{{$name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label >{{__("Special Requirements")}} </label>
                <textarea name="customer_notes" cols="30" rows="6" class="form-control" placeholder="{{__('Special Requirements')}}"></textarea>
            </div>
        </div>
    </div>
    @include ('Booking::frontend/booking/checkout-payment')

    @php
    $term_conditions = setting_item('booking_term_conditions');
    @endphp

    <div class="form-group">
        <label class="term-conditions-checkbox">
            <input type="checkbox" name="term_conditions"> {{__('I have read and accept the')}}  <a target="_blank" href="{{get_page_url($term_conditions)}}">{{__('terms and conditions')}}</a>
        </label>
    </div>
    @if(setting_item("booking_enable_recaptcha"))
        <div class="form-group">
            {{recaptcha_field('booking')}}
        </div>
    @endif
    <div class="html_before_actions"></div>

    <p class="alert-text mt10" v-show=" message.content" v-html="message.content" :class="{'danger':!message.type,'success':message.type}"></p>

    <div class="form-actions">
        <button class="btn btn-danger" @click="doCheckout">{{__('Submit')}}
            <i class="fa fa-spin fa-spinner" v-show="onSubmit"></i>
        </button>
    </div>
</div>--}}
