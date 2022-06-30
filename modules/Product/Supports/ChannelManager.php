<?php

namespace Modules\Product\Supports;

class ChannelManager
{
    protected $_all = [];

    public function add($name,$class){
        $this->_all[$name] = app()->make($class);
    }

    public function all(){
        return $this->_all;
    }
}
