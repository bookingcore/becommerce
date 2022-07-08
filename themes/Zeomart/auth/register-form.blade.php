<form class="bc-form bc-form-login {{$class ?? ''}} space-y-6" method="POST" action="{{ route('login') }}">
    <input type="hidden" name="redirect" value="{{request()->query('redirect')}}">
    @csrf
    <div class="flex">
        <div class="mr-2 w-2/4">
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("First Name *") }}</label>
            <input type="text" name="first_name" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{__("First Name")}}" required>
            <span class="invalid-feedback error error-first_name"></span>
        </div>
        <div class="ml-2 w-2/4">
            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("Last Name *") }}</label>
            <input type="text" name="last_name" id="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{__("Last Name")}}" required>
            <span class="invalid-feedback error error-last_name"></span>
        </div>
    </div>
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("Email *") }}</label>
        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="{{ __("Email") }}" required>
        <span class="invalid-feedback error error-email"></span>
    </div>
    <div>
        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __("Password *") }}</label>
        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
        <span class="invalid-feedback error error-password"></span>
    </div>
    <div class="form-group mb20">
        <input class="custom-control-input" type="checkbox" id="policy-me" value="1" name="term">
        <label for="policy-me"> {!! __("I have read and accept the <a href=':link' target='_blank'>Terms and Privacy Policy</a>",['link'=>get_page_url(setting_item('order_term_conditions'))]) !!}</label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>
    @if(setting_item("user_enable_register_recaptcha"))
        <div class="form-group mb20">
            {{recaptcha_field($captcha_action ?? 'register')}}
        </div>
    @endif
    <button type="submit" class="w-full hover:text-white bg-[#F5C34B] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ __("Register") }}
    </button>
    <div class="error message-error invalid-feedback fz14"></div>
    <div class="text-sm font-medium text-center">
        {{ __("Already have an account?") }} <a href="#"  data-modal-toggle="be-register" class="hover:underline font-bold">{{ __("Log In") }}</a>
    </div>
</form>
