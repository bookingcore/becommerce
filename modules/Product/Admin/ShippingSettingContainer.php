<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;

class ShippingSettingContainer extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/core');
    }

    public function create(Request $request)
    {
        $data = [
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Shipping Settings'),
                    'url'  => 'admin/module/core/settings/index/shipping'
                ],
                [
                    'name'  => __('Shipping Zones'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Product::admin.settings.shipping.shipping_zone', $data);
    }

    public function edit(Request $request, $id)
    {

    }

    public function store(Request $request , $id)
    {

    }
}
