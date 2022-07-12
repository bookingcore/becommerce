<?php


namespace Themes\Base\Controllers;


use Modules\Location\Models\Location;

class LocationController extends FrontendController
{

    public function set(Location $location){
        session([
            'be_location'=>$location->id
        ]);

        return back();
    }
}
