<?php
if(!empty($_SERVER['REQUEST_URI'])){

	if(strpos($_SERVER['REQUEST_URI'],'/install') !== false){
		if(!file_exists(__DIR__.'/../.env')){
			copy(__DIR__.'/../.env.example',__DIR__.'/../.env');
		}
	}
}

define('BRAVO_START', microtime(true));
define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$response = $app->handle($request = Illuminate\Http\Request::capture());

$response->send();

$app->terminate($request,$response);
