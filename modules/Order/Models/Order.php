<?php


namespace Modules\Order\Models;

use App\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Modules\Core\Helpers\HookManager;
use Modules\Coupon\Models\CouponOrder;
use Modules\Order\Emails\OrderEmail;
use Modules\Order\Events\OrderUpdated;
use Modules\Order\Resources\Admin\OrderItemResource;

class Order extends BaseModel
{

    use SoftDeletes;
    protected $table = 'core_orders';
    const COMPLETED  = 'completed'; //
    const FAILED = 'failed';
    const ON_HOLD = 'on_hold';
    const PROCESSING = 'processing';
    const PENDING = 'pending';
    const DRAFT = 'draft';
    const CANCELLED = 'cancelled';
    const PAID = 'paid';
    const UNPAID = 'unpaid';

    protected $casts = [
        'billing'=>'array'
    ];


    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }
    public function items(){
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function syncTotal(){
        $this->subtotal = $this->items->sum('subtotal');
        $discount = $this->items->sum('discount_amount');
        $shipping  = 0;
        $this->total = $this->subtotal + $shipping - $discount;
        $this->save();
    }

    public function getDetailUrl(){
        return route('order.detail',['id'=>$this->id]);
    }
    public function getGatewayObjAttribute()
    {
        return $this->gateway ? get_payment_gateway_obj($this->gateway) : false;
    }
    public function getGatewayNameAttribute()
    {
        $obj = $this->gateway_obj;
        if($obj) return $obj->getDisplayName();
    }

    public function getStatusNameAttribute()
    {
        return status_to_text($this->status);
    }

    public function getMeta($key, $default = '')
    {
        $val = OrderMeta::query()->where([
            'order_id' => $this->id,
            'name'       => $key
        ])->first();
        if (!empty($val)) {
            return $val->val;
        }
        return $default;
    }

    public function getJsonMeta($key, $default = [])
    {
        $meta = $this->getMeta($key, $default);
        if(empty($meta)) return false;
        return json_decode($meta, true);
    }

    public function addMeta($key, $val, $multiple = false)
    {

        if (is_object($val) or is_array($val))
            $val = json_encode($val);
        if ($multiple) {
            return OrderMeta::create([
                'name'       => $key,
                'val'        => $val,
                'order_id' => $this->id
            ]);
        } else {
            $old = OrderMeta::query()->where([
                'order_id' => $this->id,
                'name'       => $key
            ])->first();
            if ($old) {
                $old->val = $val;
                return $old->save();

            } else {
                return OrderMeta::create([
                    'name'       => $key,
                    'val'        => $val,
                    'order_id' => $this->id
                ]);
            }
        }
    }

    public function paymentUpdated(Payment $payment){
        switch ($payment->status){
            case self::COMPLETED:
                $this->status = $payment->status;
                $this->payment_id = $payment->id;
                $this->paid = $payment->amount;
                $this->save();
                $this->items()->update(['status'=>$this->status]);
                OrderUpdated::dispatch($this);
            break;
            case self::ON_HOLD:
            case self::PROCESSING:
            case self::CANCELLED:
                $this->status = $payment->status;
                $this->payment_id = $payment->id;
                $this->save();
                $this->items()->update(['status'=>$this->status]);
                OrderUpdated::dispatch($this);
            break;
        }
    }


    public function getDisplayNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }
    public function getShippingDisplayNameAttribute(){
        return $this->shipping_first_name.' '.$this->shipping_last_name;
    }
    public function getShippingFulLAddressAttribute(){
        $add = [
            $this->shipping_address,
            $this->shipping_city,
            $this->shipping_state,
            $this->shipping_postcode,
            $this->shipping_country,
        ];
        return implode(', ',array_filter($add));
    }

    public function search($filters){
        $query = parent::query();
        return $query;
    }


    public function markAsProcessing()
    {
        $this->status = static::PROCESSING;
        $this->save();
    }

    public function markAsPaid()
    {
        $this->status = static::PAID;
        $this->save();
    }

    public function markAsPaymentFailed(){
        $this->status = static::UNPAID;
        $this->save();

    }

    public function coupons(){
        return $this->hasMany(CouponOrder::class,'order_id');
    }

    public function vendors(){
        return $this->hasManyThrough(User::class,OrderItem::class,'order_id','id','id','vendor_id');
    }

    public function sendNewOrderEmails(){

        // Send Email
        if(setting_item('email_c_new_order_enable') and $this->customer) {
            Mail::to($this->customer)->locale($this->locale)->queue(new OrderEmail(OrderEmail::NEW_ORDER,$this));
        }
        if(setting_item('email_v_new_order_enable') and is_vendor_enable()) {
            $vendor_ids = $this->items->pluck('vendor_id')->all();
            $vendors = User::query()->whereIn('id',$vendor_ids)->get();
            if ($vendors) {
                foreach ($vendors as $vendor) {
                    Mail::to($vendor)->locale(main_locale())->queue(new OrderEmail(OrderEmail::NEW_ORDER,$this, 'vendor', $vendor));
                }
            }
        }

        if(setting_item('email_a_new_order_enable') and setting_item('email_a_new_order_recipient')) {
            Mail::to(setting_item('email_a_new_order_recipient'))->locale(main_locale())->queue(new OrderEmail(OrderEmail::NEW_ORDER,$this, 'admin'));
        }
    }

    public function getOrderReportData($from, $to){
        $report_data = new \stdClass();
        $dataOrder = parent::query()
            ->selectRaw('sum(`total`) as total_price')
            ->whereBetween('created_at', [$from, $to])
            ->where('status', self::COMPLETED)
            ->first();

        //Gross Sales
        $report_data->gloss_sales = $dataOrder->total_price ?? 0;

        //Net Sales
        $report_data->net_sales = 0;

        //Orders Placed
        $report_data->orders_placed = parent::query()
            ->whereBetween('created_at', [$from, $to])
            ->where('status', self::COMPLETED)
            ->get()->count();

        //Items Purchased
        $report_data->items_purchased = OrderItem::query()
            ->whereHas('order', function ($q) use ($from, $to){
                $q->whereBetween('created_at', [$from, $to]);
                $q->where('status', self::COMPLETED);
            })->get()->count();

        //Charged for shipping
        $report_data->total_shipping = 0;

        //Worth of coupons used
        $report_data->coupons_used = 0;

        return $report_data;
    }

    public function statues(){
        $order_statuses = array(
            static::PENDING    => __( 'Pending'  ),
            static::PROCESSING => __( 'Processing'  ),
            static::ON_HOLD    => __( 'On hold'  ),
            static::COMPLETED  => __( 'Completed'  ),
            static::CANCELLED  => __( 'Cancelled'  ),
            static::FAILED     => __( 'Failed'  ),
        );
        return apply_filters('order_statues',$order_statuses);
    }

}
