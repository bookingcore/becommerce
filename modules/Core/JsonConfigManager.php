<?php

namespace Modules\Core;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class JsonConfigManager
{
    protected static $_all = [];
    protected static function file(){
        return 'bc.json';
    }
    protected static function storage(){
        return Storage::disk("local");
    }

    protected static function save($data){
        return static::storage()->put(static::file(), json_encode($data));
    }

    public static function get($key,$default = null){

        $all = static::all();
        return $all[$key] ?? $default;

    }
    public static function set($key,$value){

        $all = static::all();
        $all[$key] = $value;

        return static::save($all);
    }

    public static function all(){
        if(empty(static::$_all)){
            try {
                static::$_all = json_decode(static::storage()->get(static::file()), true);
            }catch (\Exception $exception){
                Log::debug("JsonConfigManager: ".$exception->getMessage());
            }
        }
        return static::$_all;
    }
}
