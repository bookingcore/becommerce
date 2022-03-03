@if(is_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__("Google reCaptcha Options")}}</h3>
            <p class="form-group-desc">{{__('Config google reCaptcha for system')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="">{{__("Enable reCaptcha Login Form")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_enable_login_recaptcha" value="1" @if(setting_item('user_enable_login_recaptcha')) checked @endif /> {{__("On")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Turn on the mode for login form")}}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{__("Enable reCapcha Register Form")}}</label>
                        <div class="form-controls">
                            <label><input type="checkbox" name="user_enable_register_recaptcha" value="1" @if(setting_item('user_enable_register_recaptcha')) checked @endif /> {{__("On")}} </label>
                            <br>
                            <small class="form-text text-muted">{{__("Turn on the mode for register form")}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Registration')}}</h3>
        <div class="form-group-desc">{{ __('Email send to Customer or Administrator when user registered.')}}
            @foreach(\Modules\User\Listeners\SendMailUserRegisteredListen::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                @if(is_default_lang())
                    <div class="form-group">
                        <label> <input type="checkbox" @if(setting_item('enable_email_verification')) checked @endif name="enable_email_verification" value="1"> {{__("User must verify email after registration")}}</label>
                    </div>
                    <div class="form-group">
                        <label> <input type="checkbox" @if(setting_item('enable_mail_user_registered')) checked @endif name="enable_mail_user_registered" value="1"> {{__("Enable welcome email to customer?")}}</label>
                    </div>
                @else
                    <div class="form-group">
                        <label> <input type="checkbox" @if(setting_item('enable_mail_user_registered')) checked @endif disabled name="enable_mail_user_registered" value="1"> {{__("Enable welcome email to customer?")}}</label>
                    </div>
                    @if(!setting_item('enable_mail_user_registered'))
                        <p>{{__('You must enable on main lang.')}}</p>
                    @endif
                @endif

                <div class="form-group" data-condition="enable_mail_user_registered:is(1)">
                    <label>{{__("Email to customer content")}}</label>
                    <div class="form-controls">
                        <textarea name="user_content_email_registered" class="d-none has-tinymce" cols="30" rows="10">{{setting_item_with_lang('user_content_email_registered',request()->query('lang')) ?? '' }}</textarea>
                    </div>
                </div>


                @if(is_default_lang())
                    <div class="form-group">
                        <label> <input type="checkbox" @if(setting_item('admin_enable_mail_user_registered')) checked @endif name="admin_enable_mail_user_registered" value="1"> {{__("Enable send email to Administrator when customer registered ?")}}</label>
                    </div>
                @else
                    <div class="form-group">
                        <label> <input type="checkbox" @if(setting_item('admin_enable_mail_user_registered')) checked @endif disabled name="admin_enable_mail_user_registered" value="1"> {{__("Enable send email to Administrator when customer registered ?")}}</label>
                    </div>
                        @if(!setting_item('admin_enable_mail_user_registered'))
                            <p>{{__('You must enable on main lang.')}}</p>
                        @endif
                @endif
                <div class="form-group" data-condition="admin_enable_mail_user_registered:is(1)">
                    <label>{{__("Email to Administrator content")}}</label>
                    <div class="form-controls">
                        <textarea name="admin_content_email_user_registered" class="d-none has-tinymce" cols="30" rows="10">{{setting_item_with_lang('admin_content_email_user_registered',request()->query('lang'))?? '' }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Email Forgot Password')}}</h3>
        <div class="form-group-desc">
            @foreach(\Modules\User\Emails\ResetPasswordToken::CODE as $item=>$value)
                <div><code>{{$value}}</code></div>
            @endforeach
        </div>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <label>{{__("Content")}}</label>
                    <div class="form-controls">
                        <textarea name="user_content_email_forget_password" class="d-none has-tinymce" cols="30" rows="10">{{setting_item_with_lang('user_content_email_forget_password',request()->query('lang')) ?? '' }}</textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
