<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('General Options')}}</h3>
        <p class="form-group-desc">{{__('Change your options for vendor system')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <div class="form-controls">
                            <div class="form-group">
                                <label >{{__("Enable Multi-Vendor?")}}</label>
                                <div class="d-block">
                                <label> <input type="checkbox" @if(setting_item('vendor_enable')) checked @endif name="vendor_enable" value="1"> {{__("Yes, please")}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" data-condition="vendor_enable:is(1)">
                        <label>{{__('Commission Type')}}</label>
                        <div class="form-controls">
                            <select name="vendor_commission_type" class="form-control">
                                <option value="percent" {{($settings['vendor_commission_type'] ?? '') == 'percent' ? 'selected' : ''  }}>{{__('Percent')}}</option>
                                <option value="amount" {{($settings['vendor_commission_type'] ?? '') == 'amount' ? 'selected' : ''  }}>{{__('Amount')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" data-condition="vendor_enable:is(1)">
                        <label>{{__('Commission value')}}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="vendor_commission_amount" value="{{!empty($settings['vendor_commission_amount'])?$settings['vendor_commission_amount']:"0" }}">
                        </div>
                        <p><i>{{__('Example: 10% commission. Vendor get 90%, Admin get 10%')}}</i></p>
                    </div>
                    <hr>
                    <div class="form-group" data-condition="vendor_enable:is(1)">
                        <label>{{__("Page for Terms and Conditions")}}</label>
                        <div class="form-controls">
                            <?php
                            $template = \Modules\Page\Models\Page::find(setting_item('vendor_term_condition'));

                            \App\Helpers\AdminForm::select2('vendor_term_condition', [
                                'configs' => [
                                    'ajax' => [
                                        'url'      => url('/admin/module/page/getForSelect2'),
                                        'dataType' => 'json'
                                    ]
                                ]
                            ],
                                !empty($template->id) ? [$template->id, $template->title] : false
                            )
                            ?>
                        </div>
                    </div>
                @else
                    <p>{{__('You can edit on main lang.')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Vendor Register')}}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(is_default_lang())
                    <div class="form-group">
                        <div class="form-controls">
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('vendor_auto_approved')) checked @endif name="vendor_auto_approved" value="1"> {{__("Vendor Auto Approved?")}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-controls">
                            <div class="form-group">
                                <label> <input type="checkbox" @if(setting_item('vendor_register_captcha') == 1) checked @endif name="vendor_register_captcha" value="1"> {{__("Captcha for Register?")}}</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{__('Vendor Role')}}</label>
                        <div class="form-controls">
                            <select name="vendor_role" class="form-control">
                                @foreach(\Modules\User\Models\Role::all() as $role)
                                <option value="{{$role->id}}" {{setting_item('vendor_role') == $role->id ? 'selected': ''  }}>{{ucfirst($role->name)}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                @else
                    <p>{{__('You can edit on main lang.')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@include('Vendor::admin.settings.product')
@include('Vendor::admin.settings.payout')

