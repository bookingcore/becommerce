<?php


namespace Modules\Plugin;


use Illuminate\Support\Facades\File;

class PluginManager
{
    protected $_all = [];
    protected $_active = [];

    public function all(){

        if(!$this->_all) {
            $listModule = array_map('basename', File::directories(__DIR__));
            foreach ($listModule as $k=>$module) {
                $class = "\Plugins\\" . ucfirst($module) . "\\PluginProvider";
                if (!class_exists($class)) {
                    unset($listModule[$k]);
                }
            }

            $this->_all = $listModule;
        }
        return $this->_all;
    }

    public function activePlugins(){
        if(!$this->_active){
            $items = config('bc.active_plugins',[]);
            foreach ($items as $k=>$item){
                if(!$this->checkPlugin($item)) unset($items[$k]);
            }

            $this->_active = $items;
        }

        return $this->_active;
    }

    public function provider($plugin){
        return "\\Plugins\\".ucfirst($plugin)."\\PluginProvider";
    }

    public function active($plugin){
        if($this->checkPlugin($plugin))
        {

        }
    }

    public function checkPlugin($plugin){
        if(!file_exists(base_path('plugins/'.ucfirst($plugin).'/PluginProvider.php'))) return false;
        if(!class_exists($this->provider($plugin))) return false;
        return true;
    }
}
