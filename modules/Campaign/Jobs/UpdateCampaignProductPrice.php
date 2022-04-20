<?php

namespace Modules\Campaign\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Campaign\Models\Campaign;

class UpdateCampaignProductPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $isActive = $this->campaign->isActiveNow();
        $this->campaign->campaign_products()->with(['product'])->chunkById(20,function($campaign_products) use ($isActive){
            foreach ($campaign_products as $campaign_product){

                if ($campaign_product->product) {
                    $campaign_product->product->setRelation('active_campaign', $this->campaign);
                    $campaign_product->product->updateMinMaxPrice();
                    $campaign_product->product->save();
                }
                $campaign_product->deducted = $isActive ? 1 : 0;
                    $campaign_product->save();
            }
        });
    }
}
