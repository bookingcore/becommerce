<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Product\Models\ShippingZone;
use Modules\Product\Models\ShippingZoneLocation;
use Modules\Product\Models\ShippingZoneMethod;

class ShippingSettingContainer extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/core');
    }

    public function create(Request $request)
    {

        $this->checkPermission('setting_manage');

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
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations')->find($id);
        if (empty($shippingZone) && $id != 'other' ) {
            return redirect( url('/admin/module/core/settings/index/shipping'));
        }

        $default_zone_method = ShippingZoneMethod::query()
            ->whereNull('zone_id')
            ->get();

        $data = [
            'row' => $shippingZone,
            'default_zone_method' => $default_zone_method,
            'enable_multi_lang' => true,
            'zone_id' => $id,
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

    public function store(Request $request)
    {
        $this->checkPermission('setting_manage');
        $request->validate([
            'name'=>'required'
        ]);

        $zone_id = $request->input('zone_id');
        if(!empty($zone_id)){
            $shippingZone = ShippingZone::query()->find($zone_id);
        }else{
            $shippingZone = new ShippingZone();
        }

        $shippingZone->name = $request->input('name');
        $shippingZone->order = $request->input('order');
        $shippingZone->save();

        if ($zone_regions = $request->input('zone_regions')){
            $shippingZone->locations()->delete();
            foreach ($zone_regions as $key => $val){
                $zoneLocation = new ShippingZoneLocation();
                $zoneLocation->zone_id = $shippingZone->id;
                $zoneLocation->location_code = $val;
                $zoneLocation->save();
            }
        }

        if($zone_id > 0 ){
            return back()->with('success',  __('Shipping zone updated') );
        }else{
            return redirect( route('product.shipping.edit', ['id' => $shippingZone->id]) )->with('success', __('Shipping zone created') );
        }
    }

    public function delete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations')->find($id);
        if (!empty($shippingZone)) {
            $shippingZone->locations()->delete();
            $shippingZone->delete();
        }

        return redirect( url('/admin/module/core/settings/index/shipping') );
    }
}
