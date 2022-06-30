<?php


namespace Modules\Core\Helpers;


use Illuminate\Support\Facades\Storage;

class StorageConfig
{

    protected static $_data = [
        'BC_ACTIVE_THEME'=>'base'
    ];

    public static function save($k,$v = null){
        if(is_array($k)) static::$_data = array_merge(static::$_data,$k);
        else static::$_data[$k] = $v;

        return static::storeFile();
    }

    public static function storeFile(){
        $str = '<?php'.PHP_EOL;
        foreach (static::$_data as $k=>$v){
            if(is_array($v)){
                if(!empty($v)) $str .= 'define("'.$k.'",["'.implode('","',$v).'"]);'.PHP_EOL;
            }else{
                $str .= 'define("'.$k.'","'.$v.'");'.PHP_EOL;
            }
        }
        return Storage::disk('local')->put('bc.php', $str);
    }
}
