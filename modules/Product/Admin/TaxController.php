<?php
namespace Modules\Product\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Core\Helpers\AdminMenuManager;
use Modules\Product\Models\TaxRate;

class TaxController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        AdminMenuManager::setActive('setting');
    }

    public function create(Request $request){

        $this->checkPermission('setting_manage');

        $data = [
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Tax Settings'),
                    'url'  => 'admin/module/core/settings/tax'
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
            return redirect( url('/admin/module/core/settings/tax'));
        }

        $data = [
            'row' => $taxRate,
            'transition' => $taxRate->translate($request->query('lang')),
            'enable_multi_lang' => true,
            'breadcrumbs'        => [
                [
                    'name' => __('Tax Settings'),
                    'url'  => 'admin/module/core/settings/tax'
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
            'country',
            'state',
            'tax_rate',
            'name',
            'priority',
            'city',
            'postcode',
        ];
        $taxRate->fillByAttr($dataKeys, $request->input());
        $res = $taxRate->saveWithTranslation();
        if ($res){
            if($id > 0 ){
                return back()->with('success',  __('Tax rate updated') );
            }else{
                return redirect(route('product.tax.edit', ['id' => $taxRate]))->with('success', __('Tax rate created') );
            }
        }
    }

    public function delete(Request $request, $id){
        $this->checkPermission('setting_manage');

        $taxRate = TaxRate::find($id);
        if (!empty($taxRate)) {
            $taxRate->delete();
        }

        return back()->with('success',__("Deleted"));
    }
}
