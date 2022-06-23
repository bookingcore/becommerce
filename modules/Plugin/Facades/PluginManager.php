<?php


namespace Modules\Plugin\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class PluginManager
 * @method static \Modules\Plugin\PluginManager all()
 * @method static \Modules\Plugin\PluginManager activePlugins()
 * @method static \Modules\Plugin\PluginManager provider($plugin_name)
 * @package Modules\Plugin\Facades
 */
class PluginManager extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'plugin_manager';
    }
}
