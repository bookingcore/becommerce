<?php


namespace Modules\Product;


use Illuminate\Support\ServiceProvider;
use Modules\Product\Repositories\Contracts\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    public function boot(){
        $this->app->bind(ProductRepository::class,\Modules\Product\Repositories\Eloquent\ProductRepository::class);
    }
}
