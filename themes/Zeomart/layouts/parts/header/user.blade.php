<div class="bc-user-header zm-dropdown relative">
    <a href="#" class="flex items-center zm-dropdown-toggle">
        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8 9.16667C8.82408 9.16667 9.62966 8.92233 10.3149 8.46442C11.0001 8.00662 11.5342 7.35587 11.8495 6.59452C12.1648 5.83316 12.2474 4.99538 12.0866 4.18712C11.9258 3.37888 11.529 2.63644 10.9462 2.05373C10.3636 1.47101 9.62116 1.07417 8.81291 0.913401C8.00458 0.752626 7.16683 0.835143 6.4055 1.1505C5.64412 1.46587 4.99338 1.99993 4.53554 2.68513C4.0777 3.37033 3.83333 4.17592 3.83333 5C3.83466 6.10467 4.27406 7.1637 5.05518 7.94482C5.8363 8.72592 6.89533 9.16533 8 9.16667ZM8 2.5C8.49441 2.5 8.97783 2.64663 9.38891 2.92133C9.80008 3.19603 10.1205 3.58648 10.3097 4.04329C10.4989 4.50011 10.5484 5.00277 10.452 5.48772C10.3555 5.97268 10.1174 6.41814 9.76775 6.76777C9.41816 7.1174 8.97266 7.3555 8.48775 7.45197C8.00275 7.54842 7.50008 7.49892 7.04325 7.3097C6.5865 7.12048 6.19603 6.80005 5.92132 6.38892C5.64662 5.97781 5.5 5.49446 5.5 5C5.5 4.33696 5.76339 3.70108 6.23223 3.23223C6.70108 2.76339 7.337 2.5 8 2.5ZM0.5 18.3333V15C0.501325 13.8953 0.940733 12.8363 1.72185 12.0552C2.50297 11.2741 3.56201 10.8347 4.66666 10.8333H11.3333C12.438 10.8347 13.497 11.2741 14.2782 12.0552C15.0592 12.8363 15.4987 13.8953 15.5 15V18.3333C15.5 18.5543 15.4122 18.7663 15.2559 18.9226C15.0997 19.0788 14.8877 19.1667 14.6667 19.1667C14.4457 19.1667 14.2337 19.0788 14.0774 18.9226C13.9212 18.7663 13.8333 18.5543 13.8333 18.3333V15C13.8333 14.337 13.5699 13.7011 13.1011 13.2322C12.6322 12.7634 11.9963 12.5 11.3333 12.5H4.66666C4.00362 12.5 3.36774 12.7634 2.8989 13.2322C2.43006 13.7011 2.16667 14.337 2.16667 15V18.3333C2.16667 18.5543 2.07887 18.7663 1.92259 18.9226C1.76631 19.0788 1.55435 19.1667 1.33333 19.1667C1.11232 19.1667 0.900358 19.0788 0.744075 18.9226C0.5878 18.7663 0.5 18.5543 0.5 18.3333Z" fill="#041E42"/>
        </svg>
        <span class="text pl-2 text-sm">  {{__("Hi, :name",['name'=>Auth::user()->display_name])}} </span>
    </a>
    <div class="zm-dropdown-menu hidden origin-top-right absolute left-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
        <div class="">
            <a href="{{url(app_get_locale().'/user/profile')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                {{__("My profile")}}
            </a>
            <a href="{{route('user.order.index')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                {{__("Order History")}}
            </a>
            <a href="{{route('user.password')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                {{__("Change password")}}
            </a>
        </div>
        @if(is_vendor_enable() and is_vendor())
            <div class="border-t">
                <h6 class="text-gray-500 block px-4 pt-3 pb-1 text-sm">{{__("Store Settings")}}</h6>
                <a href="{{route('vendor.dashboard')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    {{__("Dashboard")}}
                </a>
                <a href="{{route('vendor.product')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    {{__("Products")}}
                </a>
                <a href="{{route('vendor.order')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    {{__("Orders")}}
                </a>
                <a href="{{route('vendor.payout')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    {{__("Payouts")}}
                </a>
                <a href="{{route('vendor.review')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    {{__("Reviews")}}
                </a>
            </div>
        @endif
        @if(Auth::user()->hasPermission('setting_update'))
            <div class="border-t">
                <a href="{{url('/admin')}}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">
                    {{__("Admin Dashboard")}}
                </a>
            </div>
        @endif
        <div class="border-t">
            <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form-topbar').submit();">
                {{__('Logout')}}
            </a>
        </div>
    </div>
    <form id="logout-form-topbar" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</div>
