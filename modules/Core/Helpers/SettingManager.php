<?php


namespace Modules\Core\Helpers;


class SettingManager
{
    protected static $_all;
    protected static $_zones = [];
    protected static $_zone_groups = [];

    public static function register($id,$callable,$priority = 1,$zone_id = ''){
        if(isset(static::$_all[$id]) and (static::$_all[$id]['priority'] ?? 1) > $priority) return;
        if($zone_id){
            static::$_zone_groups[$zone_id][$id] = [
                'callable'=>$callable,
                'priority'=>$priority
            ];
        }else{
            static::$_all[$id] = [
                'callable'=>$callable,
                'priority'=>$priority
            ];
        }
    }
    public static function registerZone($id,$callable,$priority = 1){
        if(isset(static::$_all[$id]) and (static::$_all[$id]['priority'] ?? 1) > $priority) return;
        static::$_zones[$id] = [
            'callable'=>$callable,
            'priority'=>$priority
        ];
    }

    public static function all($zone_id = null){
        $allSettings = [];
        if($zone_id){
            if(isset(static::$_zone_groups[$zone_id])) {
                foreach (static::$_zone_groups[$zone_id] as $id => $config) {
                    if (isset($config['callable']) and is_callable($config['callable'])) {
                        $allSettings[$id] = call_user_func($config['callable']);
                    }
                }
            }
        }else{
            foreach (static::$_all as $id=>$config){
                if(isset($config['callable']) and is_callable($config['callable']))
                {
                    $allSettings[$id] = call_user_func($config['callable']);
                }
            }
        }

        $allSettings = \Illuminate\Support\Arr::sort($allSettings, function ($value) {
            return $value['position'] ?? 0;
        });
        return $allSettings;
    }

    public static function menus(){
        $all = static::all();
        foreach ($all as $k=>$item)
        {
            $all[$k]['url'] = route('core.admin.setting',['group'=>$k]);
            $all[$k]['icon'] = $item['icon'] ?? '';
        }
        return $all;
    }

    public static function zones(){
        $all = [];
        foreach (static::$_zones as $id=>$config){
            if(isset($config['callable']) and is_callable($config['callable']))
            {
                $all[$id] = call_user_func($config['callable']);
            }
        }

        $all = \Illuminate\Support\Arr::sort($all, function ($value) {
            return $value['position'] ?? 100;
        });
        return $all;
    }

    public static function zone($id){
        $all = static::zones();
        return $all[$id] ?? null;
    }

    public static function page($page_id){
        if(isset(static::$_all[$page_id]) and isset(static::$_all[$page_id]['callable']) and is_callable(static::$_all[$page_id]['callable']))
        {
            return call_user_func(static::$_all[$page_id]['callable']);
        }
        return null;
    }
}
