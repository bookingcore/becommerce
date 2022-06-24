<?php


namespace Modules\Template;


use Modules\Template\Models\Template;

class BlockManager
{
    protected static $_all = [];

    public static function register($id,$class = null,$priority = 1){
        if(is_array($id)){
            foreach ($id as $value){
                static::register($value[0],$value[1],$value[2] ?? 1);
            }
            return;
        }
        if(isset(static::$_all[$id]) and (static::$_all[$id]['priority'] ?? 1) > $priority) return;
        static::$_all[$id] = [
            'class'=>$class,
            'priority'=>$priority
        ];
    }
    public static function all(){
        return static::$_all;
    }
    public static function blocks(){
        $res = [];
        foreach (static::$_all as $id=>$config){
            $class = $config['class'];

            if (!class_exists($class))
                continue;
            $obj = new $class();
            $options = $obj->options;
            $options['name'] = $obj->getName();
            $options['id'] = $id;
            $options['component'] = $obj->options['component'] ?? 'RegularBlock';
            $options = static::parseBlockOptions($options);
            $res[] = $options;
        }

        $res = \Illuminate\Support\Arr::sort($res, function ($value) {
            return $value['position'] ?? 0;
        });
        return $res;
    }

    public static function parseBlockOptions($options)
    {
        $options['model'] = [];
        if (!empty($options['settings'])) {
            foreach ($options['settings'] as &$setting) {

                $setting['model'] = $setting['id'];
                $val = $setting['std'] ?? '';
                switch ($setting['type']) {
                    default:
                        break;
                }
                if (!empty($setting['multiple'])) {
                    $val = (array)$val;
                }
                $options['model'][$setting['id']] = $val;
            }
        }
        return $options;
    }

    public static function content(Template $template){

        $blocks = static::all();
        $items = json_decode($template->content, true);
        if (empty($items))
            return '';
        $html = '';
        foreach ($items as $item) {
            if (empty($item['type']))
                continue;
            if (!array_key_exists($item['type'], $blocks) or !class_exists($blocks[$item['type']]['class']))
                continue;
            $item['model'] = isset($item['model']) ? $item['model'] : [];
            $blockModel = new $blocks[$item['type']]['class']();
            if (method_exists($blockModel, 'content')) {
                $html .= call_user_func([
                    $blockModel,
                    'content'
                ], $item['model']);
            }
        }
        return $html;
    }
    public static function contentAPI(Template $template){

        $res = [];
        $blocks = static::all();
        $items = json_decode($template->content, true);
        if (empty($items)) return $res;
        foreach ($items as $item) {
            if (empty($item['type']))
                continue;
            if (!array_key_exists($item['type'], $blocks) or !class_exists($blocks[$item['type']]))
                continue;
            $item['model'] = isset($item['model']) ? $item['model'] : [];
            $blockModel = new $blocks[$item['type']]();
            if (method_exists($blockModel, 'contentAPI')) {
                $item["model"] = call_user_func([
                    $blockModel,
                    'contentAPI'
                ], $item['model']);
            }
            $res[] = $item;
        }
        return $res;
    }

}
