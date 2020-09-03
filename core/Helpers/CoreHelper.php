<?php
function app(){
    return \Core\Foundation\Application::inst();
}

function response($content = '', $status = 200, array $headers = [])
{
    return app()->make('response',func_get_args());
}

include_once 'RequestHelper.php';
