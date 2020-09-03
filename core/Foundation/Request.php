<?php


namespace Core\Foundation;


use Core\Helpers\Str;

class Request
{
    public function __construct()
    {

    }

    /**
     * Determine if the request is sending JSON.
     *
     * @return bool
     */
    public function isJson()
    {
        return Str::contains($this->header('CONTENT_TYPE'), ['/json', '+json']);
    }

    public function header($key = null, $default = null)
    {
        foreach (getallheaders() as $name => $value) {
            if(strtolower($name == $key)) return $value;
        }
        return $default;
    }

}
