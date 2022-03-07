<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Product\Models\ShippingClass;
use Modules\Product\Models\ShippingZone;
use Modules\Product\Models\ShippingZoneLocation;
use Modules\Product\Models\ShippingZoneMethod;

class ShippingController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('setting');
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
                    'name'  => __('Shipping Zone'),
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

        $other_zone_methods = ShippingZoneMethod::query()
            ->where('zone_id', 0)
            ->get();

        $data = [
            'row' => $shippingZone,
            'zone_methods' => $id == 'other' ? $other_zone_methods : $shippingZone->shippingMethods,
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
        $zone_id = $request->input('zone_id');
        if($zone_id != 'other') {
            $request->validate([
                'name' => 'required'
            ]);

            if(!empty($zone_id)){
                $shippingZone = ShippingZone::query()->find($zone_id);
            }else{
                $shippingZone = new ShippingZone();
            }

            $shippingZone->name = $request->input('name');
            $shippingZone->order = $request->input('order');
            $shippingZone->save();
            $shippingZone->load('shippingMethods');

            $shippingMethods = $shippingZone->shippingMethods;
        }

        if($zone_id == 'other'){
            $shippingMethods = ShippingZoneMethod::query()
                ->where('zone_id', 0)
                ->get();
        }

        if(!empty($shippingMethods) && $shippingMethods->count() > 0){
            $shipping_methods = $request->input('shipping_methods');
            foreach ($shippingMethods as $key => $shippingMethod){
                $shippingMethod->is_enabled = $shipping_methods[$shippingMethod->id]['is_enabled'] ?? 0;
                $shippingMethod->save();
            }
        }

        if ($zone_regions = $request->input('zone_regions')){
            $shippingZone->locations()->delete();
            foreach ($zone_regions as $key => $val){
                $zoneLocation = new ShippingZoneLocation();
                $zoneLocation->zone_id = $shippingZone->id;
                $zoneLocation->location_code = $val;
                $zoneLocation->save();
            }
        }
        if($zone_id > 0 || $zone_id == 'other'){
            return back()->with('success',  __('Shipping zone updated') );
        }else{
            return redirect( route('product.shipping.edit', ['id' => $shippingZone->id]) )->with('success', __('Shipping zone created') );
        }
    }

    public function zoneDelete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $shippingZone = ShippingZone::with('locations', 'shippingMethods')->find($id);
        if (!empty($shippingZone)) {
            $shippingZone->locations()->delete();
            $shippingZone->shippingMethods()->delete();
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

        $shipping_classes = ShippingClass::all();

        $data = [
            'zone_id' => $zone_id,
            'shippingZone' => $shippingZone,
            'shipping_classes' => $shipping_classes,
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
        if(!$zoneMethod){
            return redirect( url('/admin/module/core/settings/index/shipping'));
        }
        $translation = $zoneMethod->translate($request->query('lang'));

        $method_settings = setting_item_array('shipping_method_' . $zoneMethod->id .'_settings');

        $shipping_classes = ShippingClass::all();

        $data = [
            'row' => $zoneMethod,
            'translation' => $translation,
            'zone_id' => $zone_id,
            'shippingZone' => $shippingZone,
            'method_settings' => $method_settings,
            'shipping_classes' => $shipping_classes,
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

        $request->validate([
            'title'=>'required'
        ]);

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

        if($request->input('zone_id') != 'other'){
            $dataKeys[] = 'zone_id';
        }

        $shippingMethod->fillByAttr($dataKeys, $request->input());

        $res = $shippingMethod->saveWithTranslation();

        if($res){
            $lang = $request->get('lang');
            if((empty($lang) or $lang == setting_item('site_locale'))) {
                $sz_settings = ['method_id' => $shippingMethod->method_id];
                if ($shippingMethod->method_id == 'flat_rate') {
                    $sz_settings['flat_rate_status'] = $request->input('flat_rate_status');
                    $sz_settings['flat_rate_cost'] = $request->input('flat_rate_cost');

                    //Save shipping class cost
                    $shipping_classes = ShippingClass::all();
                    if (!empty($shipping_classes) && $shipping_classes->count() > 0) {
                        foreach ($shipping_classes as $key => $shipping_class) {
                            $name = 'flat_rate_class_cost_' . $shipping_class->id;
                            $sz_settings[$name] = $request->input($name);
                        }

                        $sz_settings['flat_rate_no_class_cost'] = $request->input('flat_rate_no_class_cost');
                        $sz_settings['flat_rate_type'] = $request->input('flat_rate_type');
                    }
                }
                if ($shippingMethod->method_id == 'free_shipping') {
                    $sz_settings['free_shipping_requires'] = $request->input('free_shipping_requires');
                    $sz_settings['free_shipping_min_amount'] = $request->input('free_shipping_min_amount');
                    $sz_settings['free_shipping_ignore_discounts'] = $request->input('free_shipping_ignore_discounts');
                }
                if ($shippingMethod->method_id == 'local_pickup') {
                    $sz_settings['local_pickup_status'] = $request->input('local_pickup_status');
                    $sz_settings['local_pickup_cost'] = $request->input('local_pickup_cost');
                }

                setting_update_item('shipping_method_' . $shippingMethod->id . '_settings', $sz_settings);
            }

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

    public function shippingClassCreate(Request $request){

        $this->checkPermission('setting_manage');

        $data = [
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Shipping Settings'),
                    'url'  => 'admin/module/core/settings/index/shipping'
                ],
                [
                    'name'  => __('Shipping Class'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Product::admin.settings.shipping.shipping_class', $data);
    }

    public function shippingClassEdit(Request $request, $id){

        $this->checkPermission('setting_manage');

        $shipping_class = ShippingClass::query()->find($id);
        if (empty($shipping_class)) {
            return redirect( url('/admin/module/core/settings/index/shipping'));
        }

        $data = [
            'row' => $shipping_class,
            'translation' => $shipping_class->translate($request->query('lang')),
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Shipping Settings'),
                    'url'  => 'admin/module/core/settings/index/shipping'
                ],
                [
                    'name'  => __('Shipping Class'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Product::admin.settings.shipping.shipping_class', $data);
    }

    public function shippingClassStore(Request $request){
        $this->checkPermission('setting_manage');
        $shipping_class_id = $request->input('shipping_class_id');
        $request->validate([
            'name' => 'required'
        ]);

        if(!empty($shipping_class_id)){
            $shipping_class = ShippingClass::query()->find($shipping_class_id);
        }else{
            $shipping_class = new ShippingClass();
        }
        $dataKeys = [
            'name',
            'description'
        ];
        $shipping_class->fillByAttr($dataKeys, $request->input());

        $shipping_class->saveWithTranslation();

        if($shipping_class_id > 0){
            return back()->with('success',  __('Shipping class updated') );
        }else{
            return redirect( route('product.shipping.class.edit', ['id' => $shipping_class->id]) )->with('success', __('Shipping class created') );
        }
    }

    public function shippingClassDelete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $shipping_class = ShippingClass::find($id);
        if (!empty($shipping_class)) {
            $shipping_class->delete();
        }

        return back();
    }
}
