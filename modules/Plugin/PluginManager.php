<?php


namespace Modules\Plugin;


use Illuminate\Support\Facades\File;
use Modules\Core\Helpers\StorageConfig;

class PluginManager
{
    protected $_all = [];
    protected $_active = [];

    public function all(){

        if(!$this->_all) {
            $listModule = array_map('basename', File::directories(base_path('/plugins')));
            foreach ($listModule as $k=>$module) {
                $class = "\Plugins\\" . ucfirst($module) . "\\PluginProvider";
                if (class_exists($class)) {
                    $this->_all[$module] = $class;
                }
            }
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
        if($this->checkPlugin($plugin) and !in_array($plugin,$this->_active))
        {
            $this->_active[] = $plugin;

        }
        return StorageConfig::save('BC_ACTIVE_PLUGINS',$this->_active);
    }

    public function deactive($plugin){
        if($this->checkPlugin($plugin) and in_array($plugin,$this->_active))
        {
            foreach ($this->_active as $k=>$v){
                if($v == $plugin) unset($this->_active[$k]);
            }

        }
        return StorageConfig::save('BC_ACTIVE_PLUGINS',$this->_active);
    }


    public function checkPlugin($plugin){
        if(!file_exists(base_path('plugins/'.ucfirst($plugin).'/PluginProvider.php'))) return false;
        if(!class_exists($this->provider($plugin))) return false;
        return true;
    }
}
