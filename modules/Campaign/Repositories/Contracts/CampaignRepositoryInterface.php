<?php


namespace Modules\Campaign\Repositories\Contracts;


interface CampaignRepositoryInterface
{
    public function listActiveProducts();
    public function listSaleEndProducts();

    public function search($filter = []);
}
