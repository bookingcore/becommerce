<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Email for Vendor")}}</h3>
        <p class="form-group-desc">{{__('Set up emails for Vendor')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <div id="v_accordion">
                <div class="card mb-1">
                    <div class="card-header p-0 email-settings-header">
                        <h6 class="mb-0 p-3 d-flex align-items-center" data-toggle="collapse" data-target="#v_new_order" aria-expanded="true" aria-controls="new_order">
                            <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_v_new_order_enable')) text-success @endif"></i> {{ __("New order") }}
                        </h6>
                    </div>
                    <div id="v_new_order" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label class="" >{{__("Enable this email notification")}}</label>
                                    <div class="form-controls">
                                        <label><input type="checkbox" name="email_v_new_order_enable" value="1" @if(setting_item('email_v_new_order_enable')) checked @endif /> {{__("On")}} </label>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="" >{{__("Subject")}}</label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="email_v_new_order_subject" value="{{ setting_item_with_lang('email_v_new_order_subject',request('lang'),__('[site_title]: New order #[order_number]')) }}">
                                    <span class="small font-italic">{{ __("Available placeholders") }}: [site_title],[site_url], [order_date], [order_number]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-1">
                    <div class="card-header p-0 email-settings-header">
                        <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#v_cancelled_order" aria-expanded="false" aria-controls="cancelled_order">
                            <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_v_cancelled_order_enable')) text-success @endif"></i> {{ __("Cancelled order") }}
                        </h6>
                    </div>
                    <div id="v_cancelled_order" class="collapse" data-parent="#v_accordion">
                        <div class="card-body">
                            @if(is_default_lang())
                                <div class="form-group">
                                    <label class="" >{{__("Enable this email notification")}}</label>
                                    <div class="form-controls">
                                        <label><input type="checkbox" name="email_v_cancelled_order_enable" value="1" @if(setting_item('email_v_cancelled_order_enable')) checked @endif /> {{__("On")}} </label>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="" >{{__("Subject")}}</label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="email_v_cancelled_order_subject" value="{{ setting_item_with_lang('email_v_cancelled_order_subject') }}">
                                    <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
