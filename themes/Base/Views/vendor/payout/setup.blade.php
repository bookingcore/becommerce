<?php
$vendor_payout_methods = setting_item_array('vendor_payout_methods');
?>
@if($payout_account)
    <h4>{{__('Payout Account')}}</h4>

    <pre>
@foreach($payout_account->account_info as $val)
{{$val}}
@endforeach
    </pre>
@else
    <div class="alert bg-warning">{{__('Please setup your payout account')}}</div>
@endif
<div class="">
    <a href="#vendor_payout_accounts" data-bs-toggle="modal" class="btn btn-primary btn-sm">{{__("Setup accounts")}}</a>
</div>
<div class="modal bravo-form" tabindex="-1" role="dialog" id="vendor_payout_accounts">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__("Setup payout account")}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body ">
                <div class="accordion" id="accordionExample">
                    @foreach($vendor_payout_methods as $k=>$method)
                        @php ($method_id = $method['id'])
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading_{{$k}}">
                                <button class="accordion-button @if($payout_account and $payout_account->payout_method != $method_id) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$k}}" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="form-check">
                                        <input id="{{$method_id}}" @if($payout_account and $payout_account->payout_method == $method_id) checked @endif name="payout_method" value="{{$method_id}}" type="radio" class="form-check-input" required="">
                                        <label class="form-check-label" for="{{$method_id}}">{{$method['name'] ?? ''}}</label>
                                    </span>
                                </button>
                            </h2>
                            <div id="collapse_{{$k}}" class="accordion-collapse collapse @if($payout_account and $payout_account->payout_method == $method_id) show @endif" aria-labelledby="heading_{{$k}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <textarea name="account_info[{{$method_id}}]" class="form-control" cols="30" rows="3" placeholder="{{__("Your account info")}}">{{$payout_account->account_info[0] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="message_box alert d-none"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-success " onclick="vendorPayout.saveAccounts(this)">{{__('Save changes')}}
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>
    </div>
</div>
