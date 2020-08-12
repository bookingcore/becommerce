<div class="form-group">
    <input type="text" name="name" title="{{__('Coupon Title')}}" value="{{$row->name}}" placeholder="{{__('Coupon Title')}}" class="form-control mb-2">
    <a href="#" class="btn btn-info btn-sm generate-coupon-code">{{__('Generate coupon code')}}</a>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__('General')}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{ __('Discount type')}}</label>
            <select name="coupon_type" class="form-control">
                <option {{ $row->coupon_type == 'percent' ? 'selected="selected"' : '' }} value="percent">Percentage discount</option>
                <option {{ $row->coupon_type == 'fixed_cart' ? 'selected="selected"' : '' }} value="fixed_cart">Fixed basket discount</option>
                <option {{ $row->coupon_type == 'fixed_product' ? 'selected="selected"' : '' }} value="fixed_product">Fixed product discount</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">{{ __('Coupon amount')}} </label>
            <input type="text" name="discount" title="{{__('Coupon amount')}}" value="{{$row->discount}}" class="form-control">
        </div>
        <div class="form-group">
            <label class="control-label">{{ __('Expiration Date (Y-m-d)')}} </label>
            <div class="form-expiration">
                @php
                    $expiration = (!empty($row->expiration)) ? explode(' - ',$row->expiration) : null;
                    $start = (!empty($expiration)) ? date('Y-m-d',strtotime($expiration[0])) : date('Y-m-d');
                    $end = (!empty($expiration)) ? date('Y-m-d',strtotime($expiration[1])) : date('Y-m-d',strtotime(date('Y/m/d')."+1 days"));
                @endphp
                <input type="hidden" class="check-in-input" value="{{ $start }}" name="start">
                <input type="hidden" class="check-out-input" value="{{ $end }}" name="end">
                <input type="text" class="check-in-out form-control" name="expiration" value="{{ $start }} - {{ $end }}">
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__('Usage restriction')}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{ __('Allowed emails')}}</label>
            <div class="form-group-item">
                <div class="g-items">
                    @if(!empty($row->email) && is_array(json_decode($row->email)))
                        @php $stt = 0; @endphp
                        @foreach(json_decode($row->email) as $email)
                            <div class="item" data-number="{{$stt}}" style="padding: 0; border: none">
                                <input type="text" name="email[{{$stt}}]" class="form-control" value="{{$email}}" placeholder="Email" style="width: calc(100% - 33px); display: inline-block; height: 31px; vertical-align: top;">
                                <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                            </div>
                            @php $stt++; @endphp
                        @endforeach
                    @endif
                </div>
                <div class="text-right">
                    <span class="btn btn-info btn-sm btn-add-item"><i class="icon ion-ios-add-circle-outline"></i> {{__('Add email')}}</span>
                </div>
                <div class="g-more hide">
                    <div class="item" data-number="__number__" style="padding: 0; border: none">
                        <input type="text" __name__="email[__number__]" class="form-control" placeholder="Email" style="width: calc(100% - 33px); display: inline-block; height: 31px; vertical-align: top;">
                        <span class="btn btn-danger btn-sm btn-remove-item" style="display: inline-block"><i class="fa fa-trash"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('Allowed customer')}}</label>
            <?php
            $users = (!empty($row->customer_id)) ? \App\User::whereIn('id', json_decode($row->customer_id))->get() : false;
            $user = [];
            if (!empty($users)){
                foreach ($users as $item){
                    array_push($user, [$item->id, "$item->first_name $item->last_name"]);
                }
            }
            \App\Helpers\AdminForm::select2('vendor_id[]', [
                'configs' => [
                    'ajax'        => [
                        'url'      => url('/admin/module/user/getForSelect2'),
                        'dataType' => 'json'
                    ],
                    'allowClear'  => true,
                    'placeholder' => __('-- Vendor --')
                ]
            ], (!empty($user)) ? $user : false, true)
            ?>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-title"><strong>{{__('Usage limits')}}</strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label>{{ __('Usage limit per coupon')}}</label>
            <input type="number" class="form-control" name="per_coupon" value="{{$row->per_coupon}}" placeholder="Unlimited usage" min="0">
        </div>
        <div class="form-group">
            <label>{{ __('Usage limit per user')}}</label>
            <input type="number" class="form-control" name="per_user" value="{{$row->per_user}}" placeholder="Unlimited usage" min="0">
        </div>
    </div>
</div>
