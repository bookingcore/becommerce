<?php
namespace Modules\Core\Models;

use App\BaseModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Modules\Language\Models\Language;

class Settings extends BaseModel
{
    use HasEvents;

    protected $table = 'core_settings';
    protected static $_cached = [];

    public static function getSettings($keys)
    {
        $query = parent::query()->whereIn('name', $keys);
        $all = $query->get();

        $res = [];
        foreach ($all as $row) {
            $res[$row->name] = $row->val;
        }
        return $res;
    }

    public static function item($item, $default = false)
    {
        if(isset(static::$_cached[$item])){
            return static::$_cached[$item];
        }

        $value = Cache::rememberForever('setting_' . $item, function () use ($item ,$default) {
            $val = Settings::where('name', $item)->first();
            return ($val and $val['val'] != null) ? $val['val'] : $default;
        });

        static::$_cached[$item] = $value;

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

        if(isset(static::$_cached[$key])) unset(static::$_cached[$key]);

        Cache::forget('setting_' . $key);
    }

    public static function clearCustomCssCache(){
        $langs = Language::getActive();
        if(!empty($langs)){
            foreach ($langs as $lang)
            {
                Cache::forget("custom_css_".$lang->locale);
            }
        }
    }
}
