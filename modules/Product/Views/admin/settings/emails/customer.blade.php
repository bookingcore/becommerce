<?php
$types = [
    'new'=>[
        'default'=>__('Thanks for shopping with us')
    ],
    'cancelled'=>[
        'default'=>''
    ],
    'failed'=>[
        'default'=>''
    ],
    'on_hold'=>[
        'default'=>''
    ],
    'processing'=>[
        'default'=>''
    ],
    'completed'=>[
        'default'=>''
    ],
    'refunded'=>[
        'default'=>''
    ],
];
?>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Email for Customer")}}</h3>
        <p class="form-group-desc">{{__('Set up emails for Customer')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="form-group">
            <div id="accordion">
                @foreach($types as $type=>$configs)
                    <div class="card mb-1">
                        <div class="card-header p-0 email-settings-header">
                            <h6 class="mb-0 p-3 d-flex align-items-center" data-toggle="collapse" data-target="#{{$type}}_order" aria-expanded="true" aria-controls="new_order">
                                <i class="icon-check icon ion-ios-checkmark-circle mr-2 @if(setting_item('email_c_'.$type.'_order_enable')) text-success @endif"></i> {{ __(":type order",['type'=>ucfirst($type)]) }}
                            </h6>
                        </div>
                        <div id="{{$type}}_order" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                                @if(is_default_lang())
                                    <div class="form-group">
                                        <label class="" >{{__("Enable this email notification")}}</label>
                                        <div class="form-controls">
                                            <label><input type="checkbox" name="email_c_{{$type}}_order_enable" value="1" @if(setting_item('email_c_'.$type.'_order_enable')) checked @endif /> {{__("On")}} </label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="" >{{__("Subject")}}</label>
                                    <div class="form-controls">
                                        <input type="text" class="form-control" name="email_c_new_order_subject" value="{{ setting_item_with_lang('email_c_'.$type.'order_subject',request('lang'),$configs['default']) }}">
                                        <span class="small font-italic">{{ __("Available placeholders") }}: [site_title],[site_url], [order_date], [order_number]</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
