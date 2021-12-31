<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content relative">
            <div class="modal-header pt-4 pl-5 pr-5">
                <h4 class="modal-title">{{__('Log In')}}</h4>
                <span class="c-pointer" data-dismiss="modal" aria-label="Close">
                    <i class="input-icon field-icon fa">
                        <img src="{{url('images/ico_close.svg')}}" alt="close">
                    </i>
                </span>
            </div>
            <div class="modal-body relative p-0">
                @include('auth/login-form',['class'=>'m-0 p-0 mw-none'])
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content relative">
            <div class="modal-header pt-4 pl-5 pr-5">
                <h4 class="modal-title">{{__('Sign Up')}}</h4>
                <span class="c-pointer" data-dismiss="modal" aria-label="Close">
                    <i class="input-icon field-icon fa">
                        <img src="{{url('images/ico_close.svg')}}" alt="close">
                    </i>
                </span>
            </div>
            <div class="modal-body p-0">
                @include('auth/register-form',['class'=>'m-0 p-0 mw-none'])
            </div>
        </div>
    </div>
</div>
