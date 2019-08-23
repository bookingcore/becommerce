<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Concerns\HasEvents;

class Settings extends BaseModel
{
    use HasEvents;

    protected $table = 'core_settings';

    public static function getSettings($group = '',$locale = '')
    {
        if ($group) {
            static::where('group', $group);
        }
        $all = static::all();
        $res = [];
        foreach ($all as $row) {
            $res[$row->name] = $row->val;
        }
        return $res;
    }

    public static function item($item, $default = false)
    {
        $value = Cache::rememberForever('setting_' . $item, function () use ($item ,$default) {
            $val = Settings::where('name', $item)->first();
            return ($val and $val['val'] != null) ? $val['val'] : $default;
        });
        return $value;
    }

    public static function store($key,$data){

        $check = Settings::where('name', $key)->first();
        if($check){
            $check->val = $data;
            $check->save();
        }else{
            $check = new self();
            $check->val = $data;
            $check->name = $key;
            $check->save();
        }

        Cache::forget('setting_' . $key);
    }

    public static function getSettingPages(){
        $all = [
            [
                'id'=>'general',
                'title' => __("General Settings"),
                'position'=>10
            ],
            [
                'id'   => 'style',
                'title' => __("Style Settings"),
                'position'=>70
            ],
            [
                'id'   => 'advance',
                'title' => __("Advance Settings"),
                'position'=>80
            ],
        ];
        $all = array_merge($all,\Modules\User\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\News\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\Booking\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\Email\SettingClass::getSettingPages());
        $all = array_merge($all,\Modules\Vendor\SettingClass::getSettingPages());

        // Modules
        $custom_modules = \Modules\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Modules\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $menuConfig = call_user_func([$moduleClass,'getSettingPages']);

                    if(!empty($menuConfig)){
                        $all = array_merge($all,$menuConfig);
                    }

                }

            }
        }

        $custom_modules = \Custom\ServiceProvider::getModules();
        if(!empty($custom_modules)){
            foreach($custom_modules as $module){
                $moduleClass = "\\Custom\\".ucfirst($module)."\\ModuleProvider";
                if(class_exists($moduleClass))
                {
                    $menuConfig = call_user_func([$moduleClass,'getSettingPages']);

                    if(!empty($menuConfig)){
                        $all = array_merge($all,$menuConfig);
                    }

                }

            }
        }


        //@todo Sort items by Position
        $all = array_values(\Illuminate\Support\Arr::sort($all, function ($value) {
            return $value['position'] ?? 0;
        }));

        if(!empty($all)){
            foreach ($all as &$item)
            {
                $item['url'] = 'admin/module/core/settings/index/'.$item['id'];
                $item['name'] = $item['title'] ?? $item['id'];
                $item['icon'] = $item['icon'] ?? '';
            }
        }
        return $all;
    }
}
