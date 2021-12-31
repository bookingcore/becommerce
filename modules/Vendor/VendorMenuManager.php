<?php


namespace Modules\Vendor;


class VendorMenuManager
{
    protected static $_all = [];

    protected static $_cached = [];

    protected static $_active;

    public static function register($id,$callable,$priority = 1){
        if(isset(static::$_all[$id]) and (static::$_all[$id]['priority'] ?? 1) > $priority) return;
        static::$_all[$id] = [
            'callable'=>$callable,
            'priority'=>$priority
        ];
    }
    public static function all(){
        if(!empty(static::$_cached)){
            return static::$_cached;
        }

        $allSettings = [];
        foreach (static::$_all as $id=>$config){
            if(isset($config['callable']) and is_callable($config['callable']))
            {
                $allSettings = array_merge($allSettings,call_user_func($config['callable']));
            }
        }

        static::$_cached = \Illuminate\Support\Arr::sort($allSettings, function ($value) {
            return $value['position'] ?? 0;
        });

        return static::$_cached;
    }

    public static function menus(){
        $all = static::all();
        foreach ($all as $k=>$item)
        {
            $all[$k]['icon'] = $item['icon'] ?? '';
        }
        return $all;
    }

    public static function item($page_id){
        if(isset(static::$_all[$page_id]) and isset(static::$_all[$page_id]['callable']) and is_callable(static::$_all[$page_id]['callable']))
        {
            return call_user_func(static::$_all[$page_id]['callable']);
        }
        return null;
    }

    public static function isActive($id,$options){
        return static::$_active == $id;
    }

    public static function setActive($id){
        static::$_active = $id;
    }
}
