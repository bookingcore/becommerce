<?php


namespace Modules\Vendor\Traits;


trait VendorUser
{

    public function getVendorMode(){
        $meta = $this->getMeta('vendor_mode');
        return !$meta ? setting_item('vendor_mode') : $meta;
    }

}
