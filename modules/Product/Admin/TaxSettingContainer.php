<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Product\Models\TaxRate;

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

        $taxRate = TaxRate::find($id);
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
    }

    public function delete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $taxRate = TaxRate::with('locations')->find($id);
        if (!empty($taxRate)) {
            $taxRate->locations->delete();
            $taxRate->delete();
        }

        return back();
    }
}
