<?php
namespace Themes\Freshen\Walkers;

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
        $class = $this->menu->class ?? '';
        if (!empty($items)) {
            echo '<ul class="menu bc-department '.$class.'">';
            $this->generateTree($items);
            echo '</ul>';
        }
    }

    public function generateTree($items = [])
    {
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
            if(!empty($item['children']))
            {
                $class.=' dropdown';
            }
            echo '<li class="menu-item">';
            $item['name'] = '<span class="menu-title">'.e($item['name']).'</span>';
            if(!empty($item['icon']))
            {
                $item['name'] = '<span class="menu-icn '.e($item['icon']).'"></span>'.$item['name'];
            }
            printf('<a class="%s" target="%s" href="%s" >%s</a>', e($class) ,  e($item['target']), e($url), $item['name']);
            if (!empty($item['children'])) {
                if(!empty($item['layout']) and $item['layout'] == 'multi_row'){
                    $bg = (!empty($item['bg'])) ? 'style="background: white url('.get_file_url($item['bg'],'full').') right bottom no-repeat; background-size: 230px;"' : 'style="background: white"';
                    echo '<div class="drop-menu" '.$bg.'>';
                        $this->generateMultiRowTree($item['children']);
                    echo '</div>';
                }else{
                    echo '<ul class="child-menu">';
                        $this->generateTree($item['children']);
                    echo "</ul>";
                }
            }
            echo '</li>';
        }
    }

    public function generateMultiRowTree($items = [])
    {
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
            printf('<div class="%s one-third">', $class);
            printf('<div class="cat-title">%s</div>',  $item['name']);
            echo '<div class="menu-item-mega">';
            if (!empty($item['children'])) {
                    echo '<ul class="mb0">';
                        $this->generateTree($item['children']);
                    echo "</ul>";
            }
            echo '</div>';
            echo '</div>';
        }
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
