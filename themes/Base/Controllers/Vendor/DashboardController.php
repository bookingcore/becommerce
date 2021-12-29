<?php
namespace Themes\Base\Controllers\Vendor;

class DashboardController extends \Modules\FrontendController
{
    public function index(){
        $this->checkPermission('vendor_access');

        $data = [
            'page_title'=>__("Vendor Dashboard")
        ];

        return view('vendor.dashboard',$data);
    }
}
