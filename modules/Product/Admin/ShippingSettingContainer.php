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

    public function zoneCreate(Request $request)
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

    public function zoneEdit(Request $request, $id)
    {
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations', 'shippingMethods')->find($id);
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

    public function zoneStore(Request $request)
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

    public function zoneDelete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations')->find($id);
        if (!empty($shippingZone)) {
            $shippingZone->locations()->delete();
            $shippingZone->delete();
        }

        return redirect( url('/admin/module/core/settings/index/shipping') );
    }

    public function methodCreate(Request $request, $zone_id){
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations')->find($zone_id);
        if (empty($shippingZone) && $zone_id != 'other' ) {
            return redirect( url('/admin/module/core/settings/index/shipping'));
        }

        $data = [
            'zone_id' => $zone_id,
            'shippingZone' => $shippingZone,
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Shipping Settings'),
                    'url'  => 'admin/module/core/settings/index/shipping'
                ],
                [
                    'name'  => __('Shipping Zone'),
                    'url'  => 'admin/module/product/settings/shipping/shipping-zone/edit/' . $zone_id
                ],
                [
                    'name'  => __('Shipping Method'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Product::admin.settings.shipping.shipping_method', $data);
    }

    public function methodEdit(Request $request, $zone_id, $id){
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations')->find($zone_id);
        if (empty($shippingZone) && $zone_id != 'other' ) {
            return redirect( url('/admin/module/core/settings/index/shipping'));
        }

        $zoneMethod = ShippingZoneMethod::query()->find($id);

        $data = [
            'row' => $zoneMethod,
            'zone_id' => $zone_id,
            'shippingZone' => $shippingZone,
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Shipping Settings'),
                    'url'  => 'admin/module/core/settings/index/shipping'
                ],
                [
                    'name'  => __('Shipping Zone'),
                    'url'  => 'admin/module/product/settings/shipping/shipping-zone/edit/' . $zone_id
                ],
                [
                    'name'  => __('Shipping Method'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Product::admin.settings.shipping.shipping_method', $data);
    }

    public function methodStore(Request $request){

        $this->checkPermission('setting_manage');
        $zone_id = $request->input('zone_id');
        $shippingZone = ShippingZone::find($zone_id);
        if (empty($shippingZone) && $zone_id != 'other' ) {
            return back()->with('error',  __('Shipping zone not found') );
        }
        $zone_method_id = $request->input('zone_method_id');
        if(!empty($zone_method_id)){
            $shippingMethod = ShippingZoneMethod::query()->find($zone_method_id);
        }else{
            $shippingMethod = new ShippingZoneMethod();
        }

        $dataKeys = [
            'zone_id',
            'title',
            'is_enabled',
            'order',
            'method_id'
        ];

        $shippingMethod->fillByAttr($dataKeys, $request->input());

        $res = $shippingMethod->saveWithTranslation();

        if($res){

            if($zone_method_id > 0 ){
                return back()->with('success',  __('Shipping method updated') );
            }else{
                return redirect(route('product.shipping.method.edit', ['zone_id' => $zone_id, 'id' => $shippingMethod->id]))->with('success', __('Shipping method created') );
            }
        }

    }

    public function methodDelete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $shippingMethod = ShippingZoneMethod::find($id);
        if (!empty($shippingMethod)) {
            $shippingMethod->delete();
        }

        return back();
    }
}
