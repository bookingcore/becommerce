<?php


namespace Modules\Core\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Modules\AdminController;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductBrand;
use Modules\Product\Models\ProductCategory;

class SearchEngineController extends AdminController
{

    public function sync(Request $request,$driver)
    {
        $this->checkPermission('setting_update');
        $models = [
            Product::class,
            ProductBrand::class,
            ProductCategory::class,
        ];
        switch ($driver){
            case "algolia":

                foreach ($models as $model){
                    $model::makeAllSearchable();
                }
                break;
            default:
                return back()->with('danger',__("Please select driver"));
                break;
        }

        return back()->with('success',__("Data synchronization started"));
    }
}
