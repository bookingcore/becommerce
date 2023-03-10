<?php


namespace Modules\Vendor\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\User\Models\User;
use Modules\Vendor\Email\PayoutCalculatedEmail;
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
        $vendor = User::find($this->vendor_id);
        if(!$vendor) return;

        $payout_account = $vendor->payout_account;
        if(!$payout_account) return;

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

            $find->payout_method = $payout_account->payout_method;
            $find->account_info = $payout_account->account_info;

            $find->save();

            // Update Order Items
            $invoice_month = Carbon::createFromDate($this->year,$this->month,1);
            OrderItem::query()
                ->where('status',Order::COMPLETED)
                ->where('created_at','<',$invoice_month->lastOfMonth()->format('Y-m-d 23:59:59'))
                ->whereNull('payout_id')
                ->where('vendor_id',$this->vendor_id)
                ->update([
                    'payout_id'=>$find->id
                ]);
            // Now recalculate total
            $find->calculateTotal();

            // Now send email to vendor :)
            Mail::to($vendor)
                ->queue(new PayoutCalculatedEmail($find));
        }
    }
}
