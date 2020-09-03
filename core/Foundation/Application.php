<?php
namespace Core\Foundation;

class Application
{
    protected $base_path;
    protected static $appInst;

    protected $cachedInst;
    protected $classMap = [];

    public function __construct($base_path)
    {
        $this->base_path = $base_path;
        $this->classMap = [
            'request'=> Request::class,
            'response'=>Response::class,
            'routes'=>Route::class
        ];
    }

    public function handle($request){
        $routes = $this->singleton('routes');
        return $routes->process($request);
    }

    public function terminate($request,$response){

    }

    public function make($name){
        $c_name = $this->classMap[$name] ?? '';
        if($c_name) $a = new $c_name();

        return $a ?? null;
    }

    public function singleton($name){
        $c_name = $this->classMap[$name] ?? '';
        if(!isset($this->cachedInst[$name]) and $c_name) $this->cachedInst[$name] = new $c_name();

        return $this->cachedInst[$name] ?? null;
    }



    public static function inst(){

        return self::$appInst;
    }

    public static function setAppInst($inst){
        return static::$appInst = $inst;
    }

}
