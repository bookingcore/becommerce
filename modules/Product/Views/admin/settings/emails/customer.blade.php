<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Email for Customer")}}</h3>
        <p class="form-group-desc">{{__('Set up emails for Customer')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-title"><strong>{{__("Email for Customer")}}</strong></div>
            <div class="panel-body">
                <div class="form-group">
                    <div id="accordion">
                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 p-3 d-flex align-items-center" data-toggle="collapse" data-target="#new_order" aria-expanded="true" aria-controls="new_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_c_new_order_enable')) text-success @endif"></i> {{ __("New order") }}
                                </h6>
                            </div>
                            <div id="new_order" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_c_new_order_enable" value="1" @if(setting_item('email_c_new_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_c_new_order_subject" value="{{ setting_item_with_lang('email_c_new_order_subject',request('lang'),__('Thanks for shopping with us')) }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title],[site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#cancelled_order" aria-expanded="false" aria-controls="cancelled_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_cancelled_order_enable')) text-success @endif"></i> {{ __("Cancelled order") }}
                                </h6>
                            </div>
                            <div id="cancelled_order" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_cancelled_order_enable" value="1" @if(setting_item('email_cancelled_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="" >{{__("Recipient(s)")}}</label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" name="email_cancelled_order_recipient" value="{{ setting_item('email_cancelled_order_recipient', setting_item('admin_email')) }}">
                                                <span class="small font-italic">{{ __("Enter recipients (comma separated) for this email") }}. Ex: admin@gmail.com,example@gmail.com,...</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_cancelled_order_subject" value="{{ setting_item_with_lang('email_cancelled_order_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#failed_order" aria-expanded="false" aria-controls="failed_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_failed_order_enable')) text-success @endif"></i> {{ __("Failed order") }}
                                </h6>
                            </div>
                            <div id="failed_order" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_failed_order_enable" value="1" @if(setting_item('email_failed_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="" >{{__("Recipient(s)")}}</label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" name="email_failed_order_recipient" value="{{ setting_item('email_failed_order_recipient', setting_item('admin_email')) }}">
                                                <span class="small font-italic">{{ __("Enter recipients (comma separated) for this email") }}. Ex: admin@gmail.com,example@gmail.com,...</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_failed_order_subject" value="{{ setting_item_with_lang('email_failed_order_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#order_on_hold" aria-expanded="false" aria-controls="order_on_hold">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_order_on_hold_enable')) text-success @endif"></i> {{ __("Order on-hold") }}
                                </h6>
                            </div>
                            <div id="order_on_hold" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_order_on_hold_enable" value="1" @if(setting_item('email_order_on_hold_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_order_on_hold_subject" value="{{ setting_item_with_lang('email_order_on_hold_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#processing_order" aria-expanded="false" aria-controls="processing_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_processing_order_enable')) text-success @endif"></i> {{ __("Processing order") }}
                                </h6>
                            </div>
                            <div id="processing_order" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_processing_order_enable" value="1" @if(setting_item('email_processing_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_processing_order_subject" value="{{ setting_item_with_lang('email_processing_order_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#completed_order" aria-expanded="false" aria-controls="completed_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_completed_order_enable')) text-success @endif"></i> {{ __("Completed order") }}
                                </h6>
                            </div>
                            <div id="completed_order" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_completed_order_enable" value="1" @if(setting_item('email_completed_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_completed_order_subject" value="{{ setting_item_with_lang('email_completed_order_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#refunded_order" aria-expanded="false" aria-controls="refunded_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_refunded_order_enable')) text-success @endif"></i> {{ __("Refunded order") }}
                                </h6>
                            </div>
                            <div id="refunded_order" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_refunded_order_enable" value="1" @if(setting_item('email_refunded_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_refunded_order_subject" value="{{ setting_item_with_lang('email_refunded_order_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 collapsed p-3 d-flex align-items-center" data-toggle="collapse" data-target="#customer_invoice" aria-expanded="false" aria-controls="customer_invoice">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_customer_invoice_enable')) text-success @endif"></i> {{ __("Customer invoice") }}
                                </h6>
                            </div>
                            <div id="customer_invoice" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_customer_invoice_enable" value="1" @if(setting_item('email_customer_invoice_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject ")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_customer_invoice_subject" value="{{ setting_item_with_lang('email_customer_invoice_subject') }}">
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
    </div>
</div>
