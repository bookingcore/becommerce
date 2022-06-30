<?php

namespace Modules\Product\Models\Channels;

class PosChannel extends AbstractChannel
{

    public function getName()
    {
        return __("POS");
    }
}
