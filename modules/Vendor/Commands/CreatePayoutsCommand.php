<?php


namespace Modules\Vendor\Commands;


use Illuminate\Console\Command;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderItem;
use Modules\Vendor\Jobs\CreatePayoutForVendorJob;

class CreatePayoutsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vendor:create_payouts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate prev month payouts for all vendors ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $invoice_month = now()->firstOfMonth();
        $prevMonth = now()->subMonth();
        // Get all vendor have completed order item this month
        $query = OrderItem::query()->select(['id','vendor_id'])
                        ->where('status',Order::COMPLETED)
                        ->where('created_at','<',$invoice_month->format('Y-m-d 00:00:00'))
                        ->whereNull('payout_id')
                        ->groupBy('vendor_id');

        $query->chunkById(20,function($vendors) use ($prevMonth) {
            foreach ($vendors as $vendor){
                CreatePayoutForVendorJob::dispatch($vendor->vendor_id,$prevMonth->format('Y'),$prevMonth->format('m'));
            }
        });
    }
}
