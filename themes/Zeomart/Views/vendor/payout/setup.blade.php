<?php
$vendor_payout_methods = setting_item_array('vendor_payout_methods');
?>
@if($payout_account)
    <h4 class="text-2xl mb-4 font-medium">{{__("Payout Account")}}</h4>

    <pre>
@foreach($payout_account->account_info as $val)
{{$val}}
@endforeach
    </pre>
@else
    <div class="mb-4 alert bg-warning text-red-400">{{__('Please setup your payout account')}}</div>
@endif
<div class="mb-4">
    <a href="#vendor_payout_accounts" data-modal-toggle="vendor_payout_accounts" class="btn btn-primary text-base bg-amber-300 hover:bg-amber-400 inline-flex items-center focus:ring-4 focus:ring-amber-200">{{__("Setup accounts")}}</a>
</div>
<!-- Main modal -->
<div id="vendor_payout_accounts" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center flex">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto bravo-form">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    {{__("Setup payout account")}}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-dismiss-modal="">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div id="accordion-collapse" data-accordion="collapse">
                @foreach($vendor_payout_methods as $k=>$method)
                    @php ($method_id = $method['id'])

                    <div class="accordion-item">
                        <h2 id="accordion-collapse-heading-{{$k}}">
                            <button type="button" class="flex justify-between items-center p-5 w-full font-medium text-left text-gray-500 rounded-t-xl border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-{{$k}}" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                <span class="form-check">
                                    <input id="{{$method_id}}" @if($payout_account and $payout_account->payout_method == $method_id) checked @endif name="payout_method" value="{{$method_id}}" type="radio" class="form-check-input" required="">
                                    <label class="form-check-label" for="{{$method_id}}">{{$method['name'] ?? ''}}</label>
                                </span>
                                <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{$k}}" class="hidden" aria-labelledby="accordion-collapse-heading-{{$k}}">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <textarea name="account_info[{{$method_id}}]" class="form-control" cols="30" rows="3" placeholder="{{__("Your account info")}}">{{$payout_account->account_info[0] ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">

                <button data-dismiss-modal="" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{__("Close")}}</button>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="vendorPayout.saveAccounts(this)">{{__("Save changes")}}</button>
            </div>
        </div>
    </div>
</div>
