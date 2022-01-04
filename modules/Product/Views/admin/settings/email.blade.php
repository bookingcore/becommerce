@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Config Email')}}</h3>
            <p class="form-group-desc">{{__('Change your config email site')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__('Email Driver')}}</label>
                        <div class="form-controls">
                            <select name="email_driver" class="form-control">
                                @foreach(\Modules\Email\SettingClass::EMAIL_DRIVER as $item => $value)
                                    <option value="{{$value}}" {{setting_item('email_driver') == $value ? 'selected' : ''  }}>{{__(strtoupper($value))}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div data-operator="or" data-condition="email_driver:is(smtp),email_driver:is(sendmail),email_driver:is(mailgun),email_driver:is(postmark),email_driver:is(ses),email_driver:is(sparkpost)">
        <div class="row">
            <div class="col-sm-4">
                <h3 class="form-group-title">{{__('Config Email Service')}}</h3>
            </div>
            <div class="col-sm-8">
                <div class="panel">
                    <div class="panel-body">
                        <div data-operator="or" data-condition="email_driver:is(smtp),email_driver:is(sendmail)">
                            <div class="form-group">
                                <label>{{__('Email Host')}}</label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="email_host" value="{{ setting_item('email_host', 'smtp.mailgun.org') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('Email Port')}}</label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="email_port" value="{{ setting_item('email_port', '587') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('Email Encryption')}}</label>
                                <div class="form-controls">
                                    <select name="email_encryption" class="form-control">
                                        <option value="tls" {{ setting_item('email_encryption') == 'tls' ? 'selected' : ''  }}>TLS</option>
                                        <option value="ssl" {{ setting_item('email_encryption') == 'ssl' ? 'selected' : ''  }}>SSL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('Email Username')}}</label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="email_username" value="{{ @setting_item('email_username') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('Email Password')}}</label>
                                <div class="form-controls">
                                    <input type="password" class="form-control" name="email_password" value="{{ @setting_item('email_password') }}">
                                </div>
                            </div>
                        </div>
                        <div data-condition="email_driver:is(mailgun)">
                            <div class="form-group">
                                <label class="">{{__("Mailgun Domain")}}</label>
                                <div class="form-controls">
                                    <input autocomplete="no" type="text" class="form-control" name="email_mailgun_domain" value="{{ @setting_item('email_mailgun_domain') }}">
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="">{{__("Mailgun Secret")}}</label>
                                <div class="form-controls">
                                    <input autocomplete="no" type="text" class="form-control" name="email_mailgun_secret" value="{{ @setting_item('email_mailgun_secret') }}">
                                </div>
                            </div>
                            <div class="form-group">

                                <label class="">{{__("Mailgun Endpoint")}}</label>
                                <div class="form-controls">
                                    <input autocomplete="no" type="text" class="form-control" name="email_mailgun_endpoint" value="{{ setting_item('email_mailgun_endpoint', 'api.mailgun.net')}}">
                                </div>
                            </div>
                        </div>
                        <div data-condition="email_driver:is(postmark)">
                            <div class="form-group">
                                <label class="">{{__("Postmark Token")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_postmark_token" value="{{ @setting_item('email_postmark_token') }}">
                                </div>
                            </div>
                        </div>
                        <div data-condition="email_driver:is(ses)">
                            <div class="form-group">
                                <label class="">{{__("Ses Key")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_ses_key" value="{{ @setting_item('email_ses_key') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">{{__("Ses Secret")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_ses_secret" value="{{ @setting_item('email_ses_secret') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">{{__("Ses Region")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_ses_region" value="{{ setting_item('email_ses_secret', 'us-east-1') }}">
                                </div>
                            </div>

                        </div>
                        <div data-condition="email_driver:is(mandrill)">
                            <div class="form-group">
                                <label class="">{{__("Ses Key")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_ses_key" value="{{ @setting_item('email_ses_key') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">{{__("Ses Secret")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_ses_secret" value="{{ @setting_item('email_ses_secret') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="">{{__("Ses Region")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_ses_region" value="{{ setting_item('email_ses_region', 'us-east-1') }}">
                                </div>
                            </div>

                        </div>
                        <div data-condition="email_driver:is(sparkpost)">
                            <div class="form-group">
                                <label class="">{{__("Sparkpost Secret")}}</label>
                                <div class="form-controls">
                                    <input type="text" autocomplete="no" class="form-control" name="email_sparkpost_secret" value="{{ @setting_item('email_sparkpost_secret') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
@endif
@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Email Testing')}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <div class="form-controls">
                            <label class="">{{__("Email")}}</label>
                            <input type="email" class="form-control" id="to-email-testing" name="to_email_test"/>
                        </div>
                        <div class="form-controls">
                            <br>
                            <div id="email-testing" style="cursor: pointer;" class="btn btn-primary">{{__('Send Email Test')}}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-controls">
                            <div id="email-testing-alert" class="" role="alert">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Email Information')}}</h3>
            <p class="form-group-desc">{{__('How your customer can contact to you')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Admin Email")}}</label>
                        <div class="form-controls">
                            <input type="email" class="form-control" name="admin_email" value="{{ setting_item('admin_email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Email From Name")}}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="email_from_name" value="{{ setting_item('email_from_name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Email From Address")}}</label>
                        <div class="form-controls">
                            <input type="email" class="form-control" name="email_from_address" value="{{ setting_item('email_from_address') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endif

<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Email Notifications")}}</h3>
        <p class="form-group-desc">{{__('Email notifications sent from your site are listed below. Click on an email to configure it')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <h6 class="mb-3">{{ __("Email notifications") }}</h6>
                    <div id="accordion">
                        <div class="card mb-1">
                            <div class="card-header p-0 email-settings-header">
                                <h6 class="mb-0 p-3 d-flex align-items-center" data-toggle="collapse" data-target="#new_order" aria-expanded="true" aria-controls="new_order">
                                    <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_new_order_enable')) text-success @endif"></i> {{ __("New order") }}
                                </h6>
                            </div>
                            <div id="new_order" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    @if(is_default_lang())
                                        <div class="form-group">
                                            <label class="" >{{__("Enable this email notification")}}</label>
                                            <div class="form-controls">
                                                <label><input type="checkbox" name="email_new_order_enable" value="1" @if(setting_item('email_new_order_enable')) checked @endif /> {{__("On")}} </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="" >{{__("Recipient(s)")}}</label>
                                            <div class="form-controls">
                                                <input type="text" class="form-control" name="email_new_order_recipient" value="{{ setting_item('email_new_order_recipient', setting_item('admin_email')) }}">
                                                <span class="small font-italic">{{ __("Enter recipients (comma separated) for this email") }}. Ex: admin@gmail.com,example@gmail.com,...</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="" >{{__("Subject")}}</label>
                                        <div class="form-controls">
                                            <input type="text" class="form-control" name="email_new_order_subject" value="{{ setting_item_with_lang('email_new_order_subject') }}">
                                            <span class="small font-italic">{{ __("Available placeholders") }}: [site_title], [site_address], [site_url], [order_date], [order_number]</span>
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

@section('script.body')
    <script>
        $(document).ready(function () {
            var cant_test = 1;
            $(document).on('click', '#email-testing', function (e) {
                event.preventDefault();
                var to = $('#to-email-testing').val();
                var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                if (testEmail.test(to)) {
                    if (cant_test == 1) {
                        cant_test = 0;
                        $.ajax({
                            url: '{{url('admin/module/email/testEmail')}}',
                            type: 'get',
                            data: {to: to},
                            beforeSend: function () {
                                $('#email-testing').append(' <i class="fa  fa-spinner fa-spin"></i>').addClass('disabled');
                            },
                            success: function (res) {
                                if (res.error !== false) {
                                    $('#email-testing-alert').removeClass().addClass('alert alert-warning').html(res.messages);
                                } else {
                                    $('#email-testing-alert').removeClass().addClass('alert alert-success').html('<strong>Email Test Success!</strong>');
                                }
                                cant_test = 1;
                            },
                            complete: function () {
                                $('#email-testing').removeClass('disabled').find('i').remove();
                                cant_test = 1;

                            },
                            error: function (request, status, error) {
                                err = JSON.parse(request.responseText);
                                html = '<p><strong>' + request.statusText + '</strong></p><p>' + err.message + '</p>';
                                $('#email-testing-alert').removeClass().addClass('alert alert-warning').html(html);
                                cant_test = 1;
                            }
                        })
                    }
                } else {
                    $('#email-testing-alert').removeClass().addClass('alert alert-warning').html('Please enter valid email');
                }
                setTimeout(function () {
                    $('#email-testing-alert').html('').removeClass();
                }, 2000)
            })

        })
    </script>
@endsection
