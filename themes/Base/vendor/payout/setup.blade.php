<?php
$vendor_payout_methods = setting_item_array('vendor_payout_methods');
?>
@if($payout_account)
    <h4>{{__('Payout Account')}}</h4>

    @foreach($payout_account->account_info as $val)
        {{$val}}
    @endforeach
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
                <h5 class="modal-title">{{__("Setup payout accounts")}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__("Method")}}</th>
                            <th>{{__("Your account")}}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($vendor_payout_methods as $k=>$method)
                            @php ($method_id = $method->id)
                            <tr>
                                <td>#{{$k+1}}</td>
                                <td>
                                    <span class="method-name"><strong>{{$method->name}}</strong></span>
                                    <div class="method-desc">{!! clean($method->desc) !!}</div>
                                </td>
                                <td>
                                    <textarea name="payout_accounts[{{$method->id}}]" class="form-control" cols="30" rows="3" placeholder="{{__("Your account info")}}">{{$payout_accounts->$method_id ?? ''}}</textarea>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="message_box alert d-none"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                <button type="button" class="btn btn-success " onclick="vendorPayout.saveAccounts(this)">{{__('Save changes')}}
                    <i class="fa fa-spinner"></i>
                </button>
            </div>
        </div>
    </div>
</div>
