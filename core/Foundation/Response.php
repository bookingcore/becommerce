<?php
namespace Core\Foundation;


use Core\Helpers\Str;

class Response
{
    protected $content = '';
    protected $code = 200;
    protected $headers = [];

    public function __construct($content = '',$code = 200,$headers = [])
    {
    }

    public function send(){
        return $this;
    }
}
