<?php

namespace Modules\Customer\Resources;

use App\Resources\BaseJsonResource;

class CustomerResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'email'=>$this->email,
            'avatar_url'=>$this->avatar_url,
            'display_name'=>$this->display_name,
        ];
    }
}
