<?php

namespace Modules\Product\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Modules\Product\Supports\ChannelManager add($name,$class)
 * @method static \Modules\Product\Supports\ChannelManager all()
 */
class ChannelManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'be.channel_manager';
    }
}
