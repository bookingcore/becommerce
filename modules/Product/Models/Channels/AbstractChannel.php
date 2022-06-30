<?php

namespace Modules\Product\Models\Channels;

use App\BaseModel;

class AbstractChannel extends BaseModel
{

    public function getName(){
        return get_class($this);
    }
}
