<?php
namespace Modules;
class ModuleServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public static function getAdminMenu(){
        return [];
    }

    public static function getAdminSubmenu(){
        return [];
    }
    public static function getServices(){
        return [];
    }

    public static function getMenuBuilderTypes(){
        return [];
    }

    public static function getUserMenu(){
        return [];
    }

    public static function getUserSubMenu(){
        return [];
    }

    public static function getSettingPages(){
        return [];
    }

    public static function getProductTypes(){
        return [];
    }
    public static function getAdminProductTabs(){
        return [];
    }

    public static function getTemplateBlocks(){
        return [];
    }

    public static function getPaymentGateway(){
        return [];
    }
}
