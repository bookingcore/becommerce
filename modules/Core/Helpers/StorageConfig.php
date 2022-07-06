<?php


namespace Modules\Core\Helpers;


use Illuminate\Support\Facades\Storage;

class StorageConfig
{

    protected static $_keys = [
        'BC_ACTIVE_THEME',
        'BC_ACTIVE_PLUGINS'
    ];

    public static function save($k,$v = null){
        $data = [];
        foreach (static::$_keys as $key){
            $data[$key] = defined($key) ? constant($key) : '';
        }

        if(is_array($k)){
            $data = array_merge($data,$k);
        }
        else $data[$k] = $v;

        return static::storeFile($data);
    }

    public static function storeFile($data){
        $str = '<?php'.PHP_EOL;
        foreach ($data as $k=>$v){
            if(is_array($v)){
                if(!empty($v)) $str .= 'define("'.$k.'",["'.implode('","',$v).'"]);'.PHP_EOL;
            }else{
                $str .= 'define("'.$k.'","'.$v.'");'.PHP_EOL;
            }
        }
        return Storage::disk('local')->put('bc.php', $str);
    }
}
