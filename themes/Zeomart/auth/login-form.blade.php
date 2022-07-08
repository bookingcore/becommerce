<form class="bc-form bc-form-login {{$class ?? ''}} space-y-6" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("Username or email address") }}</label>
        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{ __("Email address") }}" required>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("Password") }}</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        <span class="invalid-feedback error error-password"></span>
    </div>
    @if(setting_item("user_enable_login_recaptcha"))
        <div class="form-group">
            {{recaptcha_field($captcha_action ?? 'login')}}
        </div>
    @endif
    <div class="flex justify-between">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" type="checkbox" name="remember" value="1" class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
            </div>
            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("Remember me") }}</label>
        </div>
        <a href="{{route('password.request')}}" class="text-sm text-blue-700 hover:underline dark:text-blue-500">{{ __("Lost your password?")  }}</a>
    </div>
    <button type="submit" class="w-full hover:text-white bg-[#F5C34B] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ __("Login") }}
    </button>
    <div class="error message-error invalid-feedback fz14"></div>
    @include("admin.message")
    <div class="text-sm font-medium text-center">
        {{ __("Not registered?") }} <a href="#"  data-modal-toggle="be-register" class="hover:underline font-bold">{{ __("Create account") }}</a>
    </div>
    @include("auth.social")
</form>
