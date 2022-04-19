<?php

namespace App\Console\Commands\Campaign;

use Illuminate\Console\Command;
use Modules\Campaign\Repositories\Contracts\CampaignRepositoryInterface;

class ScanSaleEndCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaign:sale_end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update min price for product on active campaign';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    public $campaign_repository;

    public function __construct(CampaignRepositoryInterface $campaign_repository)
    {
        parent::__construct();
        $this->campaign_repository = $campaign_repository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Check for sale end products
        $query = $this->campaign_repository->listSaleEndProducts()->with(['product']);

        $query->chunkById(20,function($campaign_products){
            foreach ($campaign_products as $campaign_product){
                if($campaign_product->product){
                    $campaign_product->product->updateMinMaxPrice();
                    $campaign_product->product->save();
                }
                $campaign_product->deducted  = 0;
                $campaign_product->save();
            }
        });
    }
}
