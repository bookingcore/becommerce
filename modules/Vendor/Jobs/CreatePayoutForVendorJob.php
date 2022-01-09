<?php


namespace Modules\Vendor\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Vendor\Models\VendorPayout;

class CreatePayoutForVendorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vendor_id;
    protected $year;
    protected $month;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($vendor_id,$year,$month)
    {
        $this->vendor_id = $vendor_id;
        $this->year = $year;
        $this->month = $month;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $where = [
            'year'=>$this->year,
            'month'=>$this->month,
            'vendor_id'=>$this->vendor_id,
        ];
        $find = VendorPayout::query()->where($where)->first();
        if(!$find){
            $find = new VendorPayout();
            $find->fillByAttr(array_keys($where),$where);
            $find->status = VendorPayout::PENDING;
            $find->save();

            // Update Order Items
            $invoice_month = Carbon::createFromDate($this->year,$this->month,1);
            OrderItem::query()
                ->where('status',Order::COMPLETED)
                ->where('created_at','<',$invoice_month->lastOfMonth()->format('Y-m-d 23:59:59'))
                ->whereNull('payout_id')
                ->whereNull('vendor_id',$this->vendor_id)
                ->update([
                    'vendor_id'=>$find->id
                ]);
            // Now recalculate total
            $find->calculateTotal();
        }
    }
}
