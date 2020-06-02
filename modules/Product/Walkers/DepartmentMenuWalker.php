<?php
namespace Modules\Product\Walkers;

class DepartmentMenuWalker
{
    protected static $currentMenuItem;
    protected        $menu;

    public function __construct($menu)
    {
        $this->menu = $menu;
    }

    public function generate()
    {
        $items = json_decode($this->menu->items, true);
        if (!empty($items)) {
            echo '<ul class="menu">';
            $this->generateTree($items);
            echo '</ul>';
        }
    }

    public function generateTree($items = [])
    {
        foreach ($items as $item) {
//            dump($item);
            /*if (!empty($item['bg'])){
                dump(get_file_url($item['bg'],'full'));
            }*/
            $class = $item['class'] ?? '';
            $url = $item['url'] ?? '';
            $item['target'] = $item['target'] ?? '';
            if (!isset($item['item_model']))
                continue;
            if (class_exists($item['item_model'])) {
                $itemClass = $item['item_model'];
                $itemObj = $itemClass::find($item['id']);
                if (empty($itemObj)) {
                    continue;
                }
                $url = $itemObj->getDetailUrl();
            }
            if ($this->checkCurrentMenu($item, $url))
                $class .= ' active';
            if(!empty($item['children']))
            {
                $class.=' menu-item-has-children';
            }

            if(!empty($item['layout']) and $item['layout'] == 'multi_row') {
                $class.=' is-mega-menu';
            }

            printf('<li class="%s menu-item">', e($class));

            if(!empty($item['icon']))
            {
                $item['name'] = '<i class="'.e($item['icon']).'"></i> '.$item['name'];
            }

            printf('<a  target="%s" href="%s" >%s</a>', e($item['target']), e($url), $item['name']);
            if (!empty($item['children'])) {
                $bg = (!empty($item['bg'])) ? 'style="background: white url('.get_file_url($item['bg'],'full').') center center no-repeat"' : 'style="background: white"';
                echo '<ul class="dropdown-submenu" '.$bg.'>';
                    if(!empty($item['layout']) and $item['layout'] == 'multi_row'){
                        $this->generateMultiRowTree($item['children']);
                    }else{
                        $this->generateTree($item['children']);
                    }
                echo "</ul>";
            }
            echo '</li>';
        }
    }


    public function generateMultiRowTree($items = [])
    {
        echo '<li>';
        echo '<div class="mega-menu-content">';
        echo '<div class="row flex-nowrap">';
        foreach ($items as $item) {

            $class = $item['class'] ?? '';
            $url = $item['url'] ?? '';
            $item['target'] = $item['target'] ?? '';
            if (!isset($item['item_model']))
                continue;
            if (class_exists($item['item_model'])) {
                $itemClass = $item['item_model'];
                $itemObj = $itemClass::find($item['id']);
                if (empty($itemObj)) {
                    continue;
                }
                $url = $itemObj->getDetailUrl();
            }
            if ($this->checkCurrentMenu($item, $url))
                $class .= ' active';


            if (!empty($item['children'])) {
                $class.=' menu-item-has-children';
            }

            printf('<div class="%s col-md-6">', $class);
            echo '<div class="menu-item-mega">';
            printf('<a  target="%s" href="%s" >%s</a>', $item['target'], $url, $item['name']);
            if (!empty($item['children'])) {
                echo '<div class="mega-menu-submenu">';
                    echo '<ul class="sub-menu check">';
                        $this->generateTree($item['children']);
                    echo "</ul>";
                echo "</div>";
            }
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';
        echo '</li>';
    }

    protected function checkCurrentMenu($item, $url = '')
    {

        if (!static::$currentMenuItem)
            return false;
        if (empty($item['item_model']))
            return false;
        if (is_string(static::$currentMenuItem) and ($url == static::$currentMenuItem or $url == url(static::$currentMenuItem))) {
            return true;
        }
        if (is_object(static::$currentMenuItem) and get_class(static::$currentMenuItem) == $item['item_model'] && static::$currentMenuItem->id == $item['id']) {
            return true;
        }
        return false;
    }

    public static function setCurrentMenuItem($item)
    {
        static::$currentMenuItem = $item;
    }

    public static function getActiveMenu()
    {
        return static::$currentMenuItem;
    }
}
