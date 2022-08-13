@if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable'))
    <div class="text-center">
        <hr>
        <p>{{ __("Connect with:") }}</p>
        <ul class="bc-list-social d-flex list-unstyled justify-content-between mx-0">
            @if(setting_item('facebook_enable'))
                <li>
                    <a class="facebook btn" href="{{url('/social-login/facebook')}}"><span><i class="fa fa-facebook"></i></span></a>
                </li>
            @endif
            @if(setting_item('google_enable'))
                <li>
                    <a class="google btn" href="{{url('social-login/google')}}"><span><i class="fa fa-google-plus"></i></span></a>
                </li>
            @endif
            @if(setting_item('twitter_enable'))
                <li>
                    <a class="twitter btn" href="{{url('social-login/twitter')}}"><span><i class="fa fa-twitter"></i></span></a>
                </li>
            @endif
        </ul>
    </div>
@endif
