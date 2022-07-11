<?php


namespace Modules\Vendor\Traits;


trait VendorUser
{

    public function getVendorMode(){
        return $this->vendor_mode != 'default' ? setting_item('vendor_mode') : $this->vendor_mode;
    }

}
