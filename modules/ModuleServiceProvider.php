<?php
namespace Modules;
class ModuleServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public static function getMenuBuilderTypes(){
        return [];
    }

    public static function getProductTypes(){
        return [];
    }
    public static function getAdminProductTabs(){
        return [];
    }

}
