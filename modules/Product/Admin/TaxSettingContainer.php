<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Product\Models\TaxRate;
use Modules\Product\Models\TaxRateLocation;

class TaxSettingContainer extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->setActiveMenu('admin/module/core');
    }

    public function create(Request $request){

        $this->checkPermission('setting_manage');

        $data = [
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Tax Settings'),
                    'url'  => 'admin/module/core/settings/index/tax'
                ],
                [
                    'name'  => __('Tax rate'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Product::admin.settings.tax.tax_rate', $data);
    }

    public function edit(Request $request, $id){

        $this->checkPermission('setting_manage');

        $taxRate = TaxRate::with('locationCity', 'locationPostcode')->find($id);
        if (empty($taxRate) ) {
            return redirect( url('/admin/module/core/settings/index/tax'));
        }

        $data = [
            'row' => $taxRate,
            'transition' => $taxRate->translate($request->query('lang')),
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Tax Settings'),
                    'url'  => 'admin/module/core/settings/index/tax'
                ],
                [
                    'name'  => __('Tax rate'),
                    'class' => 'active'
                ],
            ],
        ];
        return view('Product::admin.settings.tax.tax_rate', $data);
    }

    public function store(Request $request){
        $this->checkPermission('setting_manage');
        $id = $request->input('id');
        if(!empty($id)){
            $taxRate = TaxRate::query()->find($id);
        }else{
            $taxRate = new TaxRate();
        }

        $dataKeys = [
            'country_code',
            'state',
            'tax_rate',
            'name',
            'priority',
            'compound',
            'shipping',
            'tax_rate_class'
        ];

        $taxRate->fillByAttr($dataKeys, $request->input());

        $res = $taxRate->saveWithTranslation();
        if ($res){

            if (empty($taxRate->locationCity)){
                $locationCity = new TaxRateLocation([
                    'location_code' => $request->input('city'),
                    'location_type' => 'city'
                ]);
                $taxRate->locationCity()->save($locationCity);
            }else{
                $taxRate->locationCity->update([
                    'location_code' => $request->input('city'),
                    'location_type' => 'city'
                ]);
            }
            if (empty($taxRate->locationPostcode)){
                $locationPostcode = new TaxRateLocation([
                    'location_code' => $request->input('postcode'),
                    'location_type' => 'postcode'
                ]);
                $taxRate->locationCity()->save($locationPostcode);
            }else{
                $taxRate->locationPostcode->update([
                    'location_code' => $request->input('postcode'),
                    'location_type' => 'postcode'
                ]);
            }

            if($id > 0 ){
                return back()->with('success',  __('Tax rate updated') );
            }else{
                return redirect(route('product.tax.edit', ['id' => $taxRate]))->with('success', __('Tax rate created') );
            }
        }
    }

    public function delete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $taxRate = TaxRate::with('locations')->find($id);
        if (!empty($taxRate)) {
            $taxRate->locations()->delete();
            $taxRate->delete();
        }

        return back();
    }
}
