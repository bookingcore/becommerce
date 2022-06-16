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
                            <input type="email" class="form-control" autocomplete="none" id="to-email-testing" name="to_email_test"/>
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
                            <input type="email" class="form-control" autocomplete="off" name="admin_email" value="{{ setting_item('admin_email') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Email From Name")}}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" autocomplete="false" name="email_from_name" value="{{ setting_item('email_from_name') }}">
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
@include('Product::admin.settings.email')

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
                            type: 'post',
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
