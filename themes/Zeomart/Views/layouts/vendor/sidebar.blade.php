<?php
$user = auth()->user();
$menus = \Modules\Vendor\VendorMenuManager::menus();

?>
<nav id="sidebarMenu" class="pt-14 ">
    <div class="">
        <ul class="font-medium">
            <li class="nav-item mb-2">
                <a class="transition duration-200 px-5 py-4 block  text-base rounded-[16px] hover:bg-amber-400 @if(in_array(request()->route()->getName(),['vendor.dashboard'])) active bg-amber-400 @endif" href="{{route('vendor.dashboard')}}">
                    <div class="flex items-center">
                        <svg class="mr-4" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.3125 19.9986H4.6875C2.10281 19.9986 0 17.8958 0 15.3111V8.73798C0 7.28521 0.689649 5.89188 1.84477 5.01083L7.15727 0.958916C8.83105 -0.317686 11.1689 -0.317686 12.8427 0.958916L14.5312 2.24563V1.24856C14.5725 0.212002 16.0529 0.212783 16.0938 1.24856V3.82321C16.0938 4.1202 15.9254 4.39149 15.6592 4.52333C15.393 4.65513 15.0752 4.62458 14.8389 4.44462L11.8954 2.20153C10.7793 1.35028 9.22062 1.35028 8.1048 2.20134L2.7923 6.25325C2.02227 6.84056 1.5625 7.76942 1.5625 8.73798V15.3111C1.5625 17.0342 2.96438 18.4361 4.6875 18.4361H15.3125C17.0356 18.4361 18.4375 17.0342 18.4375 15.3111V8.73798C18.4375 7.75755 17.9829 6.82552 17.2215 6.24474C16.8784 5.98306 16.8125 5.49282 17.0741 5.14978C17.3358 4.80669 17.8261 4.74071 18.1691 5.00239C19.3155 5.87677 20 7.27325 20 8.73798V15.3111C20 17.8958 17.8972 19.9986 15.3125 19.9986ZM8.4375 9.022C7.89816 9.022 7.46094 9.45923 7.46094 9.99856C7.51254 11.2943 9.36293 11.2933 9.41406 9.99856C9.41406 9.45919 8.97684 9.022 8.4375 9.022ZM12.5391 9.99853C12.4875 11.2942 10.6371 11.2933 10.5859 9.99853C10.6375 8.70282 12.4879 8.70384 12.5391 9.99853ZM9.41406 13.1235C9.36246 14.4192 7.51207 14.4183 7.46094 13.1235C7.51254 11.8278 9.36293 11.8288 9.41406 13.1235ZM12.5391 13.1235C12.4875 14.4192 10.6371 14.4183 10.5859 13.1235C10.6375 11.8278 12.4879 11.8288 12.5391 13.1235Z" fill="#041E42"/>
                        </svg>
                    {{__('Dashboard')}}
                    </div>
                </a></li>
            @foreach ($menus as $id=>$menu)
                <li class="nav-item  mb-2">
                    <a class="transition duration-200 px-5 py-4 block  text-base rounded-[16px] hover:bg-amber-400 @if(\Modules\Vendor\VendorMenuManager::isActive($id,$menus)) active bg-amber-400 @endif" href="{{$menu['url'] ?? ''}}">

                        <div class="flex items-center">
                            @switch($menu['icon'])
                                @case("fa fa-database")
                                    <i class="flaticon mr-4 flaticon-cash-on-delivery text-xl h-5"></i>
                                @break
                                @case("fa fa-shopping-basket")
                                    <i class="flaticon mr-4 flaticon-checked-box text-xl h-5"></i>
                                @break
                                @case("fa fa-commenting")
                                    <i class="flaticon mr-4 flaticon-pencil text-xl h-5"></i>
                                @break
                                @case("fa fa-credit-card")
                                    <i class="flaticon mr-4 flaticon-wallet text-xl h-5"></i>
                                @break
                                @case("fa fa-user")
                                    <i class="flaticon mr-4 flaticon-settings text-xl h-5"></i>
                                @break
                                @default
                                    <i class="mr-4 {{$menu['icon'] ?? ''}}  h-5"></i>
                                @break
                            @endswitch
                            {{$menu['title'] ?? ''}}
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
