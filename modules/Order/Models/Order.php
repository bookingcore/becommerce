<?php


namespace Modules\Order\Models;

use App\BaseModel;
use App\Traits\HasMeta;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Modules\Coupon\Models\CouponOrder;
use Modules\Order\Emails\OrderEmail;
use Modules\Order\Events\OrderStatusUpdated;
use Modules\Order\Notifications\OrderNotification;
use Modules\Product\Models\Product;
use Modules\Product\Models\TaxRate;

class Order extends BaseModel
{

    use SoftDeletes;
    use HasMeta;

    protected $meta_parent_key = 'order_id';
    protected $metaClass = OrderMeta::class;

    protected $table = 'core_orders';
    const COMPLETED  = 'completed'; //
    const FAILED = 'failed';
    const ON_HOLD = 'on_hold';
    const PROCESSING = 'processing';
    const DRAFT = 'draft';
    const CANCELLED = 'cancelled';
    const PAID = 'paid';
    const UNPAID = 'unpaid';
    const REFUNDED = 'refunded';

    protected $casts = [
        'order_date'=>'datetime'
    ];


    public function customer(){
        return $this->belongsTo(User::class,'customer_id');
    }
    public function items(){
        return $this->hasMany(OrderItem::class,'order_id');
    }

    public function syncTotal(){
        $this->subtotal = $this->items->sum('subtotal');
        $discount = $this->discount_amount;
        $shipping  = $this->shipping_amount;
        $this->total = $this->subtotal + $shipping - $discount;
        if($this->total<0){
               $this->total=0;
        }
        $this->save();
    }

    public function getDetailUrl(){
        return route('order.detail',['code'=>$this->code]);
    }

    protected function gatewayObj(): Attribute
    {
        return Attribute::make(
            get:function(){
                return $this->gateway ? get_payment_gateway_obj($this->gateway) : false;
            }
        );
    }
    protected function gatewayName(): Attribute
    {
        return Attribute::make(
            get:function(){
                $obj = $this->gateway_obj;
                if($obj) return $obj->getDisplayName();
            }
        );
    }

    public function paymentUpdated(Payment $payment){
        if($payment->status == $payment::COMPLETED){
            $this->paid += $payment->amount;
        }
        switch ($payment->status){
            case $payment::PENDING:
                // On hold order
                $this->payment_id = $payment->id;
                $this->updateStatus(self::ON_HOLD);

                break;
            case $payment::COMPLETED:

                $this->updateStatus(self::PROCESSING);
                break;

            case $payment::FAILED:

                $this->updateStatus(self::FAILED);
                break;

        }
    }


    public function displayName(): Attribute
    {
        return Attribute::make(
            get:function(){
                return $this->first_name.' '.$this->last_name;

            }
        );
    }
    public function shippingDisplayName(): Attribute
    {
        return Attribute::make(
            get:function($value){
                return $this->shipping_first_name.' '.$this->shipping_last_name;

            }
        );
    }
    public function shippingFulLAddress(): Attribute
    {
       return Attribute::make(
           get:function($value){
               $add = [
                   $this->shipping_address,
                   $this->shipping_city,
                   $this->shipping_state,
                   $this->shipping_postcode,
                   $this->shipping_country,
               ];
               return implode(', ',array_filter($add));
           }
       );
    }

    public static function search($filters){
        $query = parent::query();
        return $query;
    }


    public function coupons(){
        return $this->hasMany(CouponOrder::class,'order_id');
    }

    public function vendors(){
        return $this->hasManyThrough(User::class,OrderItem::class,'order_id','id','id','vendor_id');
    }

    public function sendOrderNotifications($type){

        // Send Email
        if(setting_item('email_c_'.$type.'_enable')) {
            if($this->customer){
                $this->customer->notify(new OrderNotification($this,$type));
            }else{
                Notification::route('mail',$this->email)->notify(new OrderNotification($this,$type));
            }
        }
        if(setting_item('email_v_'.$type.'_enable') and is_vendor_enable()) {
            $vendor_ids = $this->items->pluck('vendor_id')->all();
            $vendors = User::query()->whereIn('id',$vendor_ids)->get();
            if ($vendors) {
                foreach ($vendors as $vendor) {
                    $vendor->notify(new OrderNotification($this,$type,'vendor'));
                }
            }
        }

        if(setting_item('email_a_'.$type.'_enable') and $address = setting_item('admin_email')) {
            Notification::route('mail',$address)->notify(new OrderNotification($this,$type,'admin'));
        }
    }

    public function getOrderReportData($from, $to){
        $report_data = new \stdClass();
        $dataOrder = parent::query()
            ->selectRaw('sum(`total` + `tax_amount` + IFNULL(`shipping_amount`,0)) as total_price,sum(total) as net_sales, sum(IFNULL(`shipping_amount`,0)) as total_ship,sum(discount_amount) as total_discount')
            ->whereBetween('order_date', [$from, $to])
            ->where('status', self::COMPLETED)
            ->first();

        //Gross Sales
        $report_data->gloss_sales = $dataOrder->total_price ?? 0;

        //Net Sales
        $report_data->net_sales = $dataOrder->net_sales?? 0;

        //Orders Placed
        $report_data->orders_placed = parent::query()
            ->whereBetween('order_date', [$from, $to])
            ->where('status', self::COMPLETED)
            ->get()->count();

        //Items Purchased
        $report_data->items_purchased = OrderItem::query()
            ->whereHas('order', function ($q) use ($from, $to){
                $q->whereBetween('order_date', [$from, $to]);
                $q->where('status', self::COMPLETED);
            })->get()->count();

        //Charged for shipping
        $report_data->total_shipping = $dataOrder->total_ship ?? 0;

        //Worth of coupons used
        $report_data->coupons_used = $dataOrder->total_discount ?? 0;

        return $report_data;
    }

    public function statues(){
        $order_statuses = array(
            static::DRAFT    => __( 'Draft'  ),
            static::PROCESSING => __( 'Processing'  ),
            static::ON_HOLD    => __( 'On hold'  ),
            static::COMPLETED  => __( 'Completed'  ),
            static::CANCELLED  => __( 'Cancelled'  ),
            static::FAILED     => __( 'Failed'  ),
        );
        return apply_filters('order_statues',$order_statuses);
    }

    public function save(array $options = [])
    {
        if (empty($this->code)){
            $this->code = $this->generateCode();
        }

        if(!$this->order_date){
            $this->order_date = Carbon::now();
        }
        if(!$this->locale){
            $this->locale = app()->getLocale();
        }
        return parent::save($options); // TODO: Change the autogenerated stub
    }

    public function saveItems($data = []){
        $order_item_ids = [];
        foreach ($data as $item) {
            if (!empty($item['id'])){
                $order_item = OrderItem::query()->where('id',$item['id'])->where('order_id',$this->id)->first();
                if(!$order_item){
                    continue;
                }
            }else{
                $order_item = new OrderItem();
                $order_item->order_id = $this->id;
            }

            $product = Product::find($item['product_id']);

            $order_item->object_id = $product->id;
            $order_item->object_model = 'product';
            $order_item->price = $product->price;
            //$order_item->discount_amount = $item->discount_amount;
            $order_item->qty = $item['qty'];
            $order_item->subtotal = $product->price * $item['qty'];
            $order_item->status = $this->status;
            $order_item->variation_id = $item['variation_id'];
            $order_item->vendor_id = $product->author_id;
            $order_item->locale = app()->getLocale();
            $order_item->order_date = $this->order_date;
            $order_item->calculateCommission();
            $order_item->save();

            $order_item_ids[] = $order_item->id;
        }
        OrderItem::query()->whereNotIn('id',$order_item_ids)->where('order_id',$this->id)->delete();

        $this->syncTotal();
    }

    public function saveTax($tax_lists){

        $tax_percent = 0;
        foreach ($tax_lists as $k=>$tax){
            if(!empty($tax['active']) and !empty($tax['tax_rate']))
            {
                $tax_percent += $tax['tax_rate'];
            }else{
                unset($tax_lists[$k]);
            }
        }
        $subtotal = $this->subtotal + $this->shipping_amount;
        $this->tax_amount = $subtotal * $tax_percent/100;
        if(!TaxRate::isPriceInclude()){
            $this->total += $this->tax_amount;
        }
        $this->save();
        $this->addMeta('tax',$tax_lists);
    }

    public function generateCode()
    {
        return md5(uniqid() . rand(0, 99999));
    }

    public function delete()
    {
        $this->items()->delete();
        return parent::delete(); // TODO: Change the autogenerated stub
    }

    public function notes(){
        return $this->hasMany(OrderNote::class);
    }

    public function updateStatus($status){

        if($status === $this->status){
            return;
        }

        $old_status = $this->status;
        $this->status = $status;

        $this->save();

        $this->addNote(OrderNote::STATUS_CHANGED,__("Order status changed from :old_status to :new_status",['old_status'=>$old_status,'new_status'=>$status]),['old_status'=>$old_status,'new_status'=>$status]);

        OrderStatusUpdated::dispatch($this,$old_status,$status);
    }

    public function addNote($name,$val = '',$extra = []){
        $note = new OrderNote([
            'name'=>$name,
            'value'=>$val,
            'extra'=>$extra
        ]);

        $this->notes()->save($note);
    }
}
